{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach (['en', 'tr', 'es', 'fr', 'pt'] as $language)
    <url>
        <loc>{{ rtrim(config('app.url'), '/') }}/{{ $language === config('seo.default_locale', 'en') ? '' : '?lang=' . $language }}</loc>
    </url>
@endforeach
</urlset>
