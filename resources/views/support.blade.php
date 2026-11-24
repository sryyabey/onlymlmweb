@extends('livewire.welcome.app')

@section('title', 'Support | OnlyMLM by SryyaLabs')

@section('seo')
    <meta name="description" content="Contact SryyaLabs for OnlyMLM support. Get help with Bagisto extension installation, configuration, licensing and technical issues.">
    <link rel="canonical" href="{{ rtrim(config('app.url'), '/') }}/support">
    <meta property="og:title" content="Support | OnlyMLM by SryyaLabs">
    <meta property="og:description" content="Installation, configuration and technical support for OnlyMLM.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ rtrim(config('app.url'), '/') }}/support">
    <style>
        .support-page a:focus-visible{outline:3px solid #0f766e;outline-offset:5px}
        .support-page h1{scroll-margin-top:7rem}
    </style>
@endsection

@section('content')
    <main class="support-page mx-auto max-w-6xl px-6 py-12 sm:py-16">
        <div class="max-w-2xl">
            <p class="text-xs font-semibold uppercase tracking-widest text-teal-700">OnlyMLM / SryyaLabs</p>
            <h1 class="title-font mt-4 text-4xl font-semibold tracking-tight text-slate-900 sm:text-5xl">How can we help?</h1>
            <p class="mt-6 text-lg leading-8 text-slate-600">Contact us for help with your OnlyMLM Bagisto extension, from installation and configuration to licensing and technical issues.</p>
        </div>

        <div class="mt-10 grid gap-6 lg:grid-cols-2">
            <section class="min-w-0 rounded-3xl border border-slate-200 bg-white p-6 sm:p-9" aria-labelledby="email-support">
                <h2 id="email-support" class="title-font text-2xl font-semibold text-slate-900">Email support</h2>
                <p class="mt-4 leading-7 text-slate-600">Send your question to our support team at SryyaLabs.</p>
                <a href="mailto:info@sryya.dev?subject=OnlyMLM%20Support" class="mt-6 inline-flex min-h-12 max-w-full items-center rounded-xl bg-slate-900 px-5 py-3 font-semibold text-white transition hover:bg-slate-800"><span class="break-all">info@sryya.dev</span></a>
                <p class="mt-4 text-sm leading-6 text-slate-500">The email link opens your email application. You can also copy the address into your preferred email service.</p>
            </section>

            <section class="min-w-0 rounded-3xl border border-slate-200 bg-white p-6 sm:p-9" aria-labelledby="documentation-support">
                <h2 id="documentation-support" class="title-font text-2xl font-semibold text-slate-900">Start with the guide</h2>
                <p class="mt-4 leading-7 text-slate-600">Our Bagisto documentation covers requirements, source-code installation, configuration, licensing and troubleshooting in five languages.</p>
                <a href="{{ route('docs.bagisto') }}" class="mt-6 inline-flex min-h-12 items-center rounded-xl border border-slate-300 px-5 py-3 font-semibold text-slate-900 transition hover:bg-slate-100">Bagisto Docs</a>
            </section>
        </div>

        <section class="mt-8 rounded-3xl border border-slate-200 bg-slate-100 p-6 sm:p-9" aria-labelledby="request-details">
            <h2 id="request-details" class="title-font text-2xl font-semibold text-slate-900">What to include in your request</h2>
            <p class="mt-4 leading-7 text-slate-600">These details help us understand and reproduce the issue:</p>
            <ul class="mt-4 list-disc space-y-3 pl-6 leading-7 text-slate-700">
                <li>Your OnlyMLM, Bagisto and PHP versions.</li>
                <li>Where you purchased the extension and your order reference, if applicable.</li>
                <li>What you expected to happen, what happened instead and the steps to reproduce it.</li>
                <li>Relevant error messages or screenshots with private information removed.</li>
            </ul>
            <p class="mt-6 text-sm leading-6 text-slate-600">Please do not email passwords, private keys, full license keys or customer records.</p>
        </section>
    </main>
@endsection
