<?php

namespace Tests\Feature;

use Tests\TestCase;

class WelcomeSeoTest extends TestCase
{
    public function test_home_language_and_canonical_are_independent_of_session_and_tracking(): void
    {
        config(['app.url' => 'https://onlymlm.com', 'seo.default_locale' => 'en']);

        foreach (['en', 'tr', 'es', 'fr', 'pt'] as $locale) {
            $canonical = 'https://onlymlm.com/'.($locale === 'en' ? '' : '?lang='.$locale);
            $response = $this->withSession(['locale' => 'fr'])->get('/?lang='.$locale.'&utm_source=test');

            $response->assertOk()
                ->assertSee('<html lang="'.$locale.'">', false)
                ->assertSee('<link rel="canonical" href="'.$canonical.'">', false)
                ->assertSee('<meta name="description" content="'.e(trans('welcome.seo.description', [], $locale)).'">', false)
                ->assertSee('application/ld+json', false)
                ->assertDontSee('utm_source=test');
        }

        $this->withSession(['locale' => 'tr'])->get('/')
            ->assertOk()->assertSee('<html lang="en">', false);
    }

    public function test_sitemap_contains_all_five_canonical_home_urls(): void
    {
        config(['app.url' => 'https://onlymlm.com', 'seo.default_locale' => 'en']);

        $response = $this->get('/sitemap.xml')->assertOk()
            ->assertHeader('Content-Type', 'application/xml; charset=UTF-8');

        $xml = simplexml_load_string($response->getContent());
        $this->assertNotFalse($xml);
        $urls = array_map(fn ($url) => (string) $url->loc, iterator_to_array($xml->url, false));
        $this->assertSame([
            'https://onlymlm.com/',
            'https://onlymlm.com/?lang=tr',
            'https://onlymlm.com/?lang=es',
            'https://onlymlm.com/?lang=fr',
            'https://onlymlm.com/?lang=pt',
        ], $urls);
    }

    public function test_unsupported_home_languages_return_not_found(): void
    {
        $this->get('/?lang=de')->assertNotFound();
        $this->get('/?lang[]=tr')->assertNotFound();
    }
}
