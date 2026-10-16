@php
    $baseUrl = rtrim(config('app.url'), '/');
    $locale = app()->getLocale();
    $homeUrl = fn ($language) => $baseUrl . '/' . ($language === config('seo.default_locale', 'en') ? '' : '?lang=' . $language);
    $canonical = $homeUrl($locale);
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'OnlyMLM',
        'url' => $canonical,
        'description' => __('welcome.seo.description'),
        'applicationCategory' => 'BusinessApplication',
        'operatingSystem' => 'Web',
        'inLanguage' => $locale,
    ];
@endphp
<meta name="description" content="{{ __('welcome.seo.description') }}">
<meta name="robots" content="index, follow, max-image-preview:large">
<link rel="canonical" href="{{ $canonical }}">
@foreach (['en', 'tr', 'es', 'fr', 'pt'] as $language)
    <link rel="alternate" hreflang="{{ $language }}" href="{{ $homeUrl($language) }}">
@endforeach
<link rel="alternate" hreflang="x-default" href="{{ $baseUrl }}/">
<meta property="og:type" content="website">
<meta property="og:site_name" content="OnlyMLM">
<meta property="og:title" content="{{ __('welcome.seo.title') }}">
<meta property="og:description" content="{{ __('welcome.seo.description') }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $baseUrl }}/img/logo.png">
<meta property="og:image:alt" content="OnlyMLM">
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="{{ __('welcome.seo.title') }}">
<meta name="twitter:description" content="{{ __('welcome.seo.description') }}">
<meta name="twitter:image" content="{{ $baseUrl }}/img/logo.png">
<script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}</script>
