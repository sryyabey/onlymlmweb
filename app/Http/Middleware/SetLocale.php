<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    /**
     * Set the application locale from session data.
     */
    public function handle(Request $request, Closure $next)
    {
        // Public home variants must render independently of a visitor's session.
        $locale = $request->is('/')
            ? $request->query('lang', config('seo.default_locale', 'en'))
            : $request->session()->get('locale', config('seo.default_locale', 'en'));

        if ($request->is('/') && !in_array($locale, ['en', 'tr', 'es', 'fr', 'pt'], true)) {
            abort(404);
        }

        if (!in_array($locale, ['en', 'tr', 'es', 'fr', 'pt'], true)) {
            $locale = config('app.fallback_locale', 'en');
        }

        App::setLocale($locale);

        return $next($request);
    }
}
