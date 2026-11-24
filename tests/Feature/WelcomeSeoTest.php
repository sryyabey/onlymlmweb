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

    public function test_home_navigation_preserves_the_selected_language(): void
    {
        foreach (['en', 'tr', 'es', 'fr', 'pt'] as $locale) {
            $homeUrl = route('home', $locale === 'en' ? [] : ['lang' => $locale]);
            $response = $this->get('/?lang='.$locale)->assertOk();

            $response->assertSee('href="'.$homeUrl.'"', false);

            foreach (['why-onlymlm', 'features', 'how-it-works', 'pricing', 'enterprise'] as $section) {
                $response->assertSee('href="'.$homeUrl.'#'.$section.'"', false);
            }

            if ($locale !== 'en') {
                $response->assertDontSee('href="'.route('home').'#', false);
            }

            $this->get($homeUrl)->assertOk()->assertSee('<html lang="'.$locale.'">', false);
        }
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
            'https://onlymlm.com/docs/bagisto',
            'https://onlymlm.com/docs/bagisto?lang=tr',
            'https://onlymlm.com/docs/bagisto?lang=ru',
            'https://onlymlm.com/docs/bagisto?lang=fr',
            'https://onlymlm.com/docs/bagisto?lang=es',
            'https://onlymlm.com/support',
        ], $urls);
    }

    public function test_unsupported_home_languages_return_not_found(): void
    {
        $this->get('/?lang=de')->assertNotFound();
        $this->get('/?lang[]=tr')->assertNotFound();
    }
}
