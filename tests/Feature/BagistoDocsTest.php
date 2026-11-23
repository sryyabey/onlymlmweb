<?php

namespace Tests\Feature;

use Tests\TestCase;

class BagistoDocsTest extends TestCase
{
    public function test_guides_render_without_authentication_or_database_content(): void
    {
        foreach (['en', 'tr', 'ru', 'fr', 'es'] as $language) {
            $url = '/docs/bagisto'.($language === 'en' ? '' : '?lang='.$language);
            $this->withSession(['locale' => 'pt'])->get($url)
                ->assertOk()
                ->assertSee('lang="'.$language.'"', false)
                ->assertSee('id="section-1"', false)
                ->assertSee('href="#section-1"', false)
                ->assertSee('php artisan nema:install')
                ->assertSee('role="region"', false)
                ->assertDontSee('href="setup.', false);
        }
    }

    public function test_unsupported_language_values_are_rejected(): void
    {
        $this->get('/docs/bagisto?lang=de')->assertNotFound();
        $this->get('/docs/bagisto?lang[]=en')->assertNotFound();
        $this->get('/docs/bagisto?lang=../../.env')->assertNotFound();
    }
}
