@extends('livewire.welcome.app')

@section('title', 'Bagisto Installation & Integration Guide | OnlyMLM')

@section('seo')
    @php($canonical = rtrim(config('app.url'), '/') . '/docs/bagisto' . ($language === 'en' ? '' : '?lang=' . $language))
    <meta name="description" content="Install and configure the OnlyMLM extension for Bagisto. Source-code setup, licensing, sponsor and binary networks, PV/CV tracking and troubleshooting.">
    <link rel="canonical" href="{{ $canonical }}">
    @foreach ($languages as $code => $label)
        <link rel="alternate" hreflang="{{ $code }}" href="{{ rtrim(config('app.url'), '/') }}/docs/bagisto{{ $code === 'en' ? '' : '?lang=' . $code }}">
    @endforeach
    <style>
        .guide-layout{display:grid;gap:2rem;max-width:76rem;margin:auto;padding:2rem 1.5rem 5rem}
        .guide-sidebar{align-self:start}.guide-sidebar nav{display:grid;gap:.6rem;margin-top:1rem}
        .guide-sidebar a{color:#334155;font-size:.875rem;line-height:1.6}.guide-sidebar a:hover{color:#087f7d;text-decoration:underline}
        .guide-article{min-width:0;padding:clamp(1rem,3vw,3rem);border:1px solid #dbe4ee;border-radius:1.5rem;background:white;line-height:1.85;overflow-wrap:anywhere}
        .guide-article h1,.guide-article h2,.guide-article h3{font-family:"Space Grotesk",system-ui,sans-serif;line-height:1.3;color:#0f172a;scroll-margin-top:7rem}
        .guide-article h1{font-size:clamp(1.8rem,4vw,2.6rem);margin-bottom:1.5rem}.guide-article h2{font-size:1.6rem;margin:2.8rem 0 1rem}.guide-article h3{font-size:1.15rem;margin:1.8rem 0 .75rem}
        .guide-article p,.guide-article ul,.guide-article ol{margin:1rem 0}.guide-article ul{list-style:disc;padding-left:1.5rem}.guide-article ol{list-style:decimal;padding-left:1.5rem}
        .guide-article a{color:#087f7d;text-decoration:underline}.guide-article pre{max-width:100%;overflow:auto;white-space:pre;overflow-wrap:normal}
        .guide-table{overflow:auto;max-inline-size:100%;max-block-size:32rem;margin:1.5rem 0;border:1px solid #dbe4ee;border-radius:.75rem}
        .guide-table table{width:100%;min-width:34rem;border-collapse:separate;border-spacing:0;font-size:.875rem}
        .guide-table th,.guide-table td{padding:.8rem 1rem;text-align:start;border-bottom:1px solid #e2e8f0;vertical-align:top}
        .guide-table thead{position:sticky;inset-block-start:0;z-index:1;background:#f1f5f9}
        .guide-layout :focus-visible{outline:3px solid #0d9488;outline-offset:4px}
        @media(min-width:1024px){.guide-layout{grid-template-columns:16rem minmax(0,1fr)}.guide-sidebar{position:sticky;top:7rem;max-height:calc(100dvh - 8rem);overflow:auto}}
        @media print{body{padding:0!important}.guide-sidebar,body>div:first-of-type,footer,body>a{display:none}.guide-layout{display:block;padding:0}.guide-article{border:0;padding:0}.guide-table{max-height:none;overflow:visible}.guide-article pre{white-space:pre-wrap}}
    </style>
@endsection

@section('content')
    <a href="#bagisto-guide" class="sr-only focus:not-sr-only">Skip to guide</a>
    <main class="guide-layout">
        <aside class="guide-sidebar" aria-label="Documentation navigation">
            <p class="text-xs font-semibold uppercase tracking-widest text-teal-700">OnlyMLM / Bagisto</p>
            <h2 class="mt-2 title-font text-2xl font-semibold">Documentation</h2>
            <nav aria-label="Guide language" class="mb-6">
                @foreach ($languages as $code => $label)
                    <a href="{{ route('docs.bagisto', $code === 'en' ? [] : ['lang' => $code]) }}" lang="{{ $code }}" hreflang="{{ $code }}" @if($language === $code) aria-current="page" @endif>{{ $label }}{{ $language === $code ? ' •' : '' }}</a>
                @endforeach
            </nav>
            <nav aria-label="On this page" lang="{{ $language }}">
                @foreach ($contents as $section)
                    <a href="#{{ $section['id'] }}">{{ $section['title'] }}</a>
                @endforeach
            </nav>
        </aside>
        <article id="bagisto-guide" class="guide-article content-body" lang="{{ $language }}" tabindex="-1">
            {!! $content !!}
        </article>
    </main>
@endsection
