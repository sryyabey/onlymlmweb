@extends('livewire.welcome.app')
@section('hero')
    <section class="relative  mx-auto w-full max-w-6xl px-6 pb-20 pt-10 md:pt-20">
        <div class="grid gap-12 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-500">{{ __('welcome.hero.tagline') }}</p>
                <h1 class="title-font mt-6 text-4xl font-semibold leading-tight text-slate-900 md:text-5xl">
                    {{ __('welcome.hero.title') }}
                </h1>
                <p class="mt-6 text-lg text-slate-600">
                    {{ __('welcome.hero.description') }}
                </p>
                <div class="mt-8 flex flex-wrap items-center gap-4">
                    <a href="#pricing"
                        class="rounded-full bg-teal-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-teal-700">
                        {{ __('welcome.hero.cta_primary') }}
                    </a>
                    <a href="#features"
                        class="rounded-full border border-slate-300 px-6 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:text-slate-900">
                        {{ __('welcome.hero.cta_secondary') }}
                    </a>
                </div>
                <div class="mt-10 grid grid-cols-2 gap-6 text-sm text-slate-500 md:grid-cols-4">
                    <div>
                        <p class="title-font text-xl font-semibold text-slate-900">{{ __('welcome.hero.stats.mlm_binary_title') }}</p>
                        <p>{{ __('welcome.hero.stats.mlm_binary_sub') }}</p>
                    </div>
                    <div>
                        <p class="title-font text-xl font-semibold text-slate-900">{{ __('welcome.hero.stats.bagisto_title') }}</p>
                        <p>{{ __('welcome.hero.stats.bagisto_sub') }}</p>
                    </div>
                    <div>
                        <p class="title-font text-xl font-semibold text-slate-900">{{ __('welcome.hero.stats.auto_member_title') }}</p>
                        <p>{{ __('welcome.hero.stats.auto_member_sub') }}</p>
                    </div>
                    <div>
                        <p class="title-font text-xl font-semibold text-slate-900">{{ __('welcome.hero.stats.career_bonus_title') }}</p>
                        <p>{{ __('welcome.hero.stats.career_bonus_sub') }}</p>
                    </div>
                </div>
            </div>

            <div class="grid gap-6">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg">
                    <div class="rounded-2xl bg-slate-900 p-5 text-slate-200">
                        <div class="flex items-center justify-between text-xs text-slate-400">
                            <span class="uppercase tracking-[0.2em]">{{ __('welcome.hero.panel.title') }}</span>
                            <span>{{ __('welcome.hero.panel.subtitle') }}</span>
                        </div>
                        <div class="mt-4 grid gap-4 lg:grid-cols-[1.2fr_0.8fr]">
                            <div class="rounded-xl bg-slate-800/70 p-4">
                                <p class="text-xs uppercase tracking-[0.2em] text-slate-400">{{ __('welcome.hero.panel.network_health') }}</p>
                                <p class="mt-2 text-2xl font-semibold text-white">{{ __('welcome.hero.panel.configurable') }}</p>
                                <div class="mt-4 grid gap-2 text-xs text-slate-400">
                                    <div class="flex items-center justify-between">
                                        <span>{{ __('welcome.hero.panel.binary_balance') }}</span>
                                        <span class="text-emerald-300">{{ __('welcome.hero.panel.rule_based') }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span>{{ __('welcome.hero.panel.payment_security') }}</span>
                                        <span class="text-emerald-300">{{ __('welcome.hero.panel.auditable') }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span>{{ __('welcome.hero.panel.active_licenses') }}</span>
                                        <span>{{ __('welcome.hero.panel.domain_based') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="rounded-xl bg-slate-950 p-4">
                                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">{{ __('welcome.hero.panel.realtime') }}</p>
                                <p class="mt-2 text-lg font-semibold text-white">{{ __('welcome.hero.panel.revenue_stream') }}</p>
                                <div
                                    class="mt-4 h-24 rounded-lg bg-gradient-to-t from-teal-600/40 via-slate-800 to-slate-900 p-2">
                                    <div class="h-full w-full rounded-lg border border-slate-700/70"></div>
                                </div>
                                <p class="mt-3 text-xs text-slate-400">{{ __('welcome.hero.panel.commission_tracking') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">{{ __('welcome.hero.topology.title') }}</p>
                            <p class="title-font mt-2 text-lg font-semibold text-slate-900">{{ __('welcome.hero.topology.subtitle') }}</p>
                        </div>
                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs text-slate-600">{{ __('welcome.hero.topology.badge') }}</span>
                    </div>
                    <div class="mt-4 rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <svg viewBox="0 0 360 170" class="h-40 w-full">
                            <defs>
                                <linearGradient id="node" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#0ea5a4" />
                                    <stop offset="100%" stop-color="#1d3347" />
                                </linearGradient>
                            </defs>
                            <line x1="180" y1="25" x2="110" y2="80" stroke="#94a3b8" stroke-width="2" />
                            <line x1="180" y1="25" x2="250" y2="80" stroke="#94a3b8" stroke-width="2" />
                            <line x1="110" y1="80" x2="70" y2="140" stroke="#cbd5f5" stroke-width="2" />
                            <line x1="110" y1="80" x2="150" y2="140" stroke="#cbd5f5" stroke-width="2" />
                            <line x1="250" y1="80" x2="210" y2="140" stroke="#cbd5f5" stroke-width="2" />
                            <line x1="250" y1="80" x2="290" y2="140" stroke="#cbd5f5" stroke-width="2" />
                            <circle cx="180" cy="25" r="16" fill="url(#node)" />
                            <circle cx="110" cy="80" r="14" fill="#0f172a" />
                            <circle cx="250" cy="80" r="14" fill="#0f172a" />
                            <circle cx="70" cy="140" r="12" fill="#1f2937" />
                            <circle cx="150" cy="140" r="12" fill="#1f2937" />
                            <circle cx="210" cy="140" r="12" fill="#1f2937" />
                            <circle cx="290" cy="140" r="12" fill="#1f2937" />
                        </svg>
                        <div class="mt-2 grid grid-cols-3 gap-2 text-xs text-slate-500">
                            <span>{{ __('welcome.hero.topology.transparent_enrollment') }}</span>
                            <span>{{ __('welcome.hero.topology.branch_balance') }}</span>
                            <span>{{ __('welcome.hero.topology.auditable_rules') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section id="why-onlymlm" class="grid-pattern border-y border-slate-200 bg-white">
        <div class="mx-auto w-full max-w-6xl px-6 py-20">
            <div class="grid gap-10 lg:grid-cols-[1fr_1.1fr] lg:items-center">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-500">{{ __('welcome.why.eyebrow') }}</p>
                    <h2 class="title-font mt-4 text-3xl font-semibold text-slate-900 md:text-4xl">{{ __('welcome.why.title') }}</h2>
                </div>
                <p class="text-lg text-slate-600">
                    {{ __('welcome.why.description') }}
                </p>
            </div>
            <div class="mt-12 grid gap-6 md:grid-cols-3">
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
                    <p class="title-font text-lg font-semibold text-slate-900">{{ __('welcome.why.cards.control_title') }}</p>
                    <p class="mt-3 text-sm text-slate-600">{{ __('welcome.why.cards.control_body') }}</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
                    <p class="title-font text-lg font-semibold text-slate-900">{{ __('welcome.why.cards.ownership_title') }}</p>
                    <p class="mt-3 text-sm text-slate-600">{{ __('welcome.why.cards.ownership_body') }}</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
                    <p class="title-font text-lg font-semibold text-slate-900">{{ __('welcome.why.cards.transparency_title') }}</p>
                    <p class="mt-3 text-sm text-slate-600">{{ __('welcome.why.cards.transparency_body') }}</p>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="mx-auto w-full max-w-6xl px-6 py-20">
        <div class="flex flex-wrap items-end justify-between gap-6">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-500">{{ __('welcome.features.eyebrow') }}</p>
                <h2 class="title-font mt-4 text-3xl font-semibold text-slate-900 md:text-4xl">{{ __('welcome.features.title') }}</h2>
            </div>
            <p class="max-w-xl text-sm text-slate-600">
                {{ __('welcome.features.description') }}
            </p>
        </div>
        <div class="mt-12 grid gap-6 md:grid-cols-2">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-teal-600 text-white">ML</span>
                    <div>
                        <p class="title-font text-lg font-semibold text-slate-900">{{ __('welcome.features.items.engine_title') }}</p>
                        <p class="text-sm text-slate-500">{{ __('welcome.features.items.engine_body') }}</p>
                    </div>
                </div>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-900 text-white">BG</span>
                    <div>
                        <p class="title-font text-lg font-semibold text-slate-900">{{ __('welcome.features.items.bagisto_title') }}</p>
                        <p class="text-sm text-slate-500">{{ __('welcome.features.items.bagisto_body') }}</p>
                    </div>
                </div>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-700 text-white">LC</span>
                    <div>
                        <p class="title-font text-lg font-semibold text-slate-900">{{ __('welcome.features.items.licensing_title') }}</p>
                        <p class="text-sm text-slate-500">{{ __('welcome.features.items.licensing_body') }}</p>
                    </div>
                </div>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-teal-700 text-white">API</span>
                    <div>
                        <p class="title-font text-lg font-semibold text-slate-900">{{ __('welcome.features.items.api_title') }}</p>
                        <p class="text-sm text-slate-500">{{ __('welcome.features.items.api_body') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="how-it-works" class="border-y border-slate-200 bg-white">
        <div class="mx-auto w-full max-w-6xl px-6 py-20">
            <div class="grid gap-8 lg:grid-cols-[1fr_1.1fr]">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-500">{{ __('welcome.how.eyebrow') }}</p>
                    <h2 class="title-font mt-4 text-3xl font-semibold text-slate-900 md:text-4xl">{{ __('welcome.how.title') }}</h2>
                </div>
                <p class="text-lg text-slate-600">
                    {{ __('welcome.how.description') }}
                </p>
            </div>
            <div class="mt-12 grid gap-6 md:grid-cols-3">
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
                    <p class="title-font text-lg font-semibold text-slate-900">{{ __('welcome.how.steps.one_title') }}</p>
                    <p class="mt-3 text-sm text-slate-600">{{ __('welcome.how.steps.one_body') }}</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
                    <p class="title-font text-lg font-semibold text-slate-900">{{ __('welcome.how.steps.two_title') }}</p>
                    <p class="mt-3 text-sm text-slate-600">{{ __('welcome.how.steps.two_body') }}</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
                    <p class="title-font text-lg font-semibold text-slate-900">{{ __('welcome.how.steps.three_title') }}</p>
                    <p class="mt-3 text-sm text-slate-600">{{ __('welcome.how.steps.three_body') }}</p>
                </div>
            </div>
        </div>
    </section>

    <section id="pricing" class="mx-auto w-full max-w-6xl px-6 py-20">
        <div class="text-center">
            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-500">{{ __('welcome.pricing.eyebrow') }}</p>
            <h2 class="title-font mt-4 text-3xl font-semibold text-slate-900 md:text-4xl">{{ __('welcome.pricing.title') }}</h2>
            <p class="mt-4 text-lg text-slate-600">
                {{ __('welcome.pricing.description') }}
            </p>
        </div>
        <div class="mt-12 grid gap-6 lg:grid-cols-3">
            <div id="marketplace" class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">{{ __('welcome.pricing.cards.self_eyebrow') }}</p>
                <p class="title-font mt-3 text-2xl font-semibold text-slate-900">{{ __('welcome.pricing.cards.self_title') }}</p>
                <p class="title-font mt-2 text-3xl font-semibold text-slate-900">{{ __('welcome.pricing.cards.self_price') }}</p>
                <p class="mt-2 text-sm text-slate-600">
                    {{ __('welcome.pricing.cards.self_body') }}
                </p>
                <ul class="mt-6 space-y-3 text-sm text-slate-600">
                    <li>{{ __('welcome.pricing.lists.self.0') }}</li>
                    <li>{{ __('welcome.pricing.lists.self.1') }}</li>
                    <li>{{ __('welcome.pricing.lists.self.2') }}</li>
                    <li>{{ __('welcome.pricing.lists.self.3') }}</li>
                    <li>{{ __('welcome.pricing.lists.self.4') }}</li>
                </ul>
                <span
                    class="mt-8 inline-flex w-full items-center justify-center rounded-xl bg-slate-100 px-5 py-3 text-sm font-semibold text-slate-600">
                    {{ __('welcome.pricing.cards.self_cta') }}
                </span>
            </div>
            <div class="rounded-2xl border border-slate-900 bg-slate-900 p-8 text-white shadow-lg">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-300">{{ __('welcome.pricing.cards.guided_eyebrow') }}</p>
                <p class="title-font mt-3 text-2xl font-semibold">{{ __('welcome.pricing.cards.guided_title') }}</p>
                <p class="title-font mt-2 text-3xl font-semibold">{{ __('welcome.pricing.cards.guided_price') }}</p>
                <p class="mt-2 text-sm text-slate-200">
                    {{ __('welcome.pricing.cards.guided_body') }}
                </p>
                <ul class="mt-6 space-y-3 text-sm text-slate-200">
                    <li>{{ __('welcome.pricing.lists.guided.0') }}</li>
                    <li>{{ __('welcome.pricing.lists.guided.1') }}</li>
                    <li>{{ __('welcome.pricing.lists.guided.2') }}</li>
                    <li>{{ __('welcome.pricing.lists.guided.3') }}</li>
                    <li>{{ __('welcome.pricing.lists.guided.4') }}</li>
                </ul>
                <a href="mailto:support@onlymlm.com?subject=OnlyMLM%20Professional%20License"
                    class="mt-8 inline-flex w-full items-center justify-center rounded-xl bg-white px-5 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-100">
                    {{ __('welcome.pricing.cards.guided_cta') }}
                </a>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">{{ __('welcome.pricing.cards.done_eyebrow') }}</p>
                <p class="title-font mt-3 text-2xl font-semibold text-slate-900">{{ __('welcome.pricing.cards.done_title') }}</p>
                <p class="title-font mt-2 text-3xl font-semibold text-slate-900">{{ __('welcome.pricing.cards.done_price') }}</p>
                <p class="mt-2 text-sm text-slate-600">
                    {{ __('welcome.pricing.cards.done_body') }}
                </p>
                <ul class="mt-6 space-y-3 text-sm text-slate-600">
                    <li>{{ __('welcome.pricing.lists.done.0') }}</li>
                    <li>{{ __('welcome.pricing.lists.done.1') }}</li>
                    <li>{{ __('welcome.pricing.lists.done.2') }}</li>
                    <li>{{ __('welcome.pricing.lists.done.3') }}</li>
                    <li>{{ __('welcome.pricing.lists.done.4') }}</li>
                </ul>
                <a href="mailto:support@onlymlm.com?subject=OnlyMLM%20Enterprise%20License"
                    class="mt-8 inline-flex w-full items-center justify-center rounded-xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-800 transition hover:border-slate-400 hover:bg-slate-50">
                    {{ __('welcome.pricing.cards.done_cta') }}
                </a>
            </div>
        </div>
        <p class="text-xs text-slate-500 mt-6">
            {{ __('welcome.pricing.note') }}
        </p>
    </section>

    <section id="faq" class="border-t border-slate-200 bg-white">
        <div class="mx-auto w-full max-w-6xl px-6 py-20">
            <div class="mb-12 text-center">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-500">{{ __('welcome.faq.eyebrow') }}</p>
                <h2 class="title-font mt-4 text-3xl font-semibold text-slate-900 md:text-4xl">
                    {{ __('welcome.faq.title') }}
                </h2>
            </div>
            <div class="grid gap-6 md:grid-cols-2">
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
                    <p class="title-font text-lg font-semibold text-slate-900">{{ __('welcome.faq.q1') }}</p>
                    <p class="mt-3 text-sm text-slate-600">{{ __('welcome.faq.a1') }}</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
                    <p class="title-font text-lg font-semibold text-slate-900">{{ __('welcome.faq.q2') }}</p>
                    <p class="mt-3 text-sm text-slate-600">{{ __('welcome.faq.a2') }}</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
                    <p class="title-font text-lg font-semibold text-slate-900">{{ __('welcome.faq.q3') }}</p>
                    <p class="mt-3 text-sm text-slate-600">{{ __('welcome.faq.a3') }}</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
                    <p class="title-font text-lg font-semibold text-slate-900">{{ __('welcome.faq.q4') }}</p>
                    <p class="mt-3 text-sm text-slate-600">{{ __('welcome.faq.a4') }}</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
                    <p class="title-font text-lg font-semibold text-slate-900">{{ __('welcome.faq.q5') }}</p>
                    <p class="mt-3 text-sm text-slate-600">{{ __('welcome.faq.a5') }}</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
                    <p class="title-font text-lg font-semibold text-slate-900">{{ __('welcome.faq.q6') }}</p>
                    <p class="mt-3 text-sm text-slate-600">{{ __('welcome.faq.a6') }}</p>
                </div>
            </div>
        </div>
    </section>

    <section id="enterprise" class="border-t border-slate-200 bg-white">
        <div class="mx-auto w-full max-w-6xl px-6 py-20">
            <div class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-500">{{ __('welcome.demo.eyebrow') }}</p>
                    <h2 class="title-font mt-4 text-3xl font-semibold text-slate-900 md:text-4xl">{{ __('welcome.demo.title') }}</h2>
                    <p class="mt-4 text-lg text-slate-600">
                        {{ __('welcome.demo.description') }}
                    </p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-slate-950 p-8 text-white shadow-lg">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-teal-300">
                        {{ __('welcome.demo.form.eyebrow') }}
                    </p>
                    <p class="title-font mt-4 text-2xl font-semibold">{{ __('welcome.demo.form.title') }}</p>
                    <p class="mt-3 text-sm leading-6 text-slate-300">{{ __('welcome.demo.form.body') }}</p>
                    <a href="mailto:support@onlymlm.com?subject=OnlyMLM%20Enterprise%20License"
                        class="mt-6 inline-flex w-full items-center justify-center rounded-xl bg-white px-6 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-100">
                        {{ __('welcome.demo.form.submit') }}
                    </a>
                    <p class="mt-4 text-xs text-slate-400">{{ __('welcome.demo.form.note') }}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
