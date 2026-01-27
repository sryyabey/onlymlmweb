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
        $locale = $request->session()->get('locale', config('app.locale'));

        if (!in_array($locale, ['en', 'tr', 'es', 'fr', 'pt'], true)) {
            $locale = config('app.fallback_locale', 'en');
        }

        App::setLocale($locale);

        return $next($request);
    }
}
