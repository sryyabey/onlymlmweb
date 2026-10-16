@php($currentLocale = app()->getLocale())
<nav
    class="fixed left-0 right-0 top-0 z-50 mx-auto flex w-full max-w-6xl items-center justify-between border-b border-slate-200 bg-white/90 px-6 py-4 backdrop-blur">
    <a href="{{ route('home') }}">
        <div class="flex items-center gap-3">

            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-900 text-white shadow-sm">
                <img src="{{ asset('img/logo.png') }}" alt="OnlyMLM Logo">
            </div>
            <div>
                <p class="title-font text-lg font-semibold tracking-tight text-slate-900">OnlyMLM</p>
                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">{{ __('layout.nav.tagline') }}</p>
            </div>

        </div>
    </a>
    <div class="hidden items-center gap-8 text-sm text-slate-600 md:flex">
        <a href="{{ route('home') }}#why-onlymlm"
            class="rounded-full px-3 py-1 transition hover:bg-slate-100 hover:text-slate-900">{{ __('layout.nav.why') }}</a>
        <a href="{{ route('home') }}#features"
            class="rounded-full px-3 py-1 transition hover:bg-slate-100 hover:text-slate-900">{{ __('layout.nav.platform') }}</a>
        <a href="{{ route('home') }}#how-it-works"
            class="rounded-full px-3 py-1 transition hover:bg-slate-100 hover:text-slate-900">{{ __('layout.nav.how') }}</a>
        <a href="{{ route('home') }}#pricing"
            class="rounded-full px-3 py-1 transition hover:bg-slate-100 hover:text-slate-900">{{ __('layout.nav.pricing') }}</a>
        <a href="{{ route('documents') }}"
            class="rounded-full px-3 py-1 transition hover:bg-slate-100 hover:text-slate-900">{{ __('layout.nav.documents') }}</a>
    </div>
    <div class="hidden items-center gap-4 md:flex">
        <details class="relative">
            <summary
                class="flex items-center gap-2 rounded-full border border-slate-200 px-3 py-1.5 text-xs font-semibold text-slate-600 transition hover:border-slate-300 hover:text-slate-900">
                {{ strtoupper($currentLocale) }}
                <svg class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.7a.75.75 0 1 1 1.06 1.06l-4.24 4.25a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08Z"
                        clip-rule="evenodd" />
                </svg>
            </summary>
            <div
                class="absolute right-0 z-50 mt-2 w-40 rounded-xl border border-slate-200 bg-white p-2 text-xs font-semibold text-slate-600 shadow-xl">
                <div class="grid grid-cols-1 gap-1 max-h-56 overflow-y-auto overscroll-contain">
                    <a href="{{ route('home', ['lang' => 'tr']) }}"
                        class="flex items-center gap-3 rounded-lg px-3 py-2 leading-none transition hover:bg-slate-100 hover:text-slate-900 {{ $currentLocale === 'tr' ? 'text-slate-900' : '' }}">
                        <span
                            class="flex h-7 w-7 items-center justify-center rounded-lg border border-slate-200 bg-white text-base shadow-sm">🇹🇷</span>
                        <span class="whitespace-nowrap truncate max-w-[80px]">TR</span>
                    </a>
                    <a href="{{ route('home', ['lang' => 'en']) }}"
                        class="flex items-center gap-3 rounded-lg px-3 py-2 leading-none transition hover:bg-slate-100 hover:text-slate-900 {{ $currentLocale === 'en' ? 'text-slate-900' : '' }}">
                        <span
                            class="flex h-7 w-7 items-center justify-center rounded-lg border border-slate-200 bg-white text-base shadow-sm">🇬🇧</span>
                        <span class="whitespace-nowrap truncate max-w-[80px]">EN</span>
                    </a>
                    <a href="{{ route('home', ['lang' => 'es']) }}"
                        class="flex items-center gap-3 rounded-lg px-3 py-2 leading-none transition hover:bg-slate-100 hover:text-slate-900 {{ $currentLocale === 'es' ? 'text-slate-900' : '' }}">
                        <span
                            class="flex h-7 w-7 items-center justify-center rounded-lg border border-slate-200 bg-white text-base shadow-sm">🇪🇸</span>
                        <span class="whitespace-nowrap truncate max-w-[80px]">ES</span>
                    </a>
                    <a href="{{ route('home', ['lang' => 'fr']) }}"
                        class="flex items-center gap-3 rounded-lg px-3 py-2 leading-none transition hover:bg-slate-100 hover:text-slate-900 {{ $currentLocale === 'fr' ? 'text-slate-900' : '' }}">
                        <span
                            class="flex h-7 w-7 items-center justify-center rounded-lg border border-slate-200 bg-white text-base shadow-sm">🇫🇷</span>
                        <span class="whitespace-nowrap truncate max-w-[80px]">FR</span>
                    </a>
                    <a href="{{ route('home', ['lang' => 'pt']) }}"
                        class="flex items-center gap-3 rounded-lg px-3 py-2 leading-none transition hover:bg-slate-100 hover:text-slate-900 {{ $currentLocale === 'pt' ? 'text-slate-900' : '' }}">
                        <span
                            class="flex h-7 w-7 items-center justify-center rounded-lg border border-slate-200 bg-white text-base shadow-sm">🇵🇹</span>
                        <span class="whitespace-nowrap truncate max-w-[80px]">PT</span>
                    </a>
                </div>
            </div>
        </details>
        <a href="{{ route('home') }}#pricing"
            class="rounded-full bg-slate-900 px-5 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">{{ __('layout.nav.request_demo') }}</a>
    </div>
    <details class="relative md:hidden">
        <summary
            class="flex items-center gap-2 rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:text-slate-900">
            {{ __('layout.nav.menu') }}
            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                    d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.7a.75.75 0 1 1 1.06 1.06l-4.24 4.25a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08Z"
                    clip-rule="evenodd" />
            </svg>
        </summary>
        <div
            class="absolute right-0 z-50 mt-3 w-56 rounded-2xl border border-slate-200 bg-white p-4 text-sm text-slate-600 shadow-lg">
            <div class="flex flex-col gap-1">
                <a href="{{ route('home') }}#why-onlymlm"
                    class="rounded-lg px-3 py-2 transition hover:bg-slate-100 hover:text-slate-900">{{ __('layout.nav.why') }}</a>
                <a href="{{ route('home') }}#features"
                    class="rounded-lg px-3 py-2 transition hover:bg-slate-100 hover:text-slate-900">{{ __('layout.nav.platform') }}</a>
                <a href="{{ route('home') }}#how-it-works"
                    class="rounded-lg px-3 py-2 transition hover:bg-slate-100 hover:text-slate-900">{{ __('layout.nav.how') }}</a>
                <a href="{{ route('home') }}#pricing"
                    class="rounded-lg px-3 py-2 transition hover:bg-slate-100 hover:text-slate-900">{{ __('layout.nav.pricing') }}</a>
                <a href="{{ route('home') }}#enterprise"
                    class="rounded-lg px-3 py-2 transition hover:bg-slate-100 hover:text-slate-900">{{ __('layout.nav.demo') }}</a>
                <a href="{{ route('documents') }}"
                    class="rounded-lg px-3 py-2 transition hover:bg-slate-100 hover:text-slate-900">{{ __('layout.nav.documents') }}</a>
            </div>
            <div class="mt-4 flex items-center justify-between text-xs font-semibold text-slate-500">
                <span class="uppercase tracking-[0.2em]">{{ __('layout.nav.language') }}</span>
                <details class="relative">
                    <summary
                        class="flex items-center gap-2 rounded-full border border-slate-200 px-3 py-1.5 text-xs font-semibold text-slate-600 transition hover:border-slate-300 hover:text-slate-900">
                        {{ strtoupper($currentLocale) }}
                        <svg class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.7a.75.75 0 1 1 1.06 1.06l-4.24 4.25a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08Z"
                                clip-rule="evenodd" />
                        </svg>
                    </summary>
                    <div
                        class="absolute right-0 z-50 mt-2 w-40 rounded-xl border border-slate-200 bg-white p-2 text-xs font-semibold text-slate-600 shadow-xl">
                        <div class="grid grid-cols-1 gap-1 max-h-56 overflow-y-auto overscroll-contain">
                            <a href="{{ route('home', ['lang' => 'tr']) }}"
                                class="flex items-center gap-3 rounded-lg px-3 py-2 leading-none transition hover:bg-slate-100 hover:text-slate-900 {{ $currentLocale === 'tr' ? 'text-slate-900' : '' }}">
                                <span
                                    class="flex h-7 w-7 items-center justify-center rounded-lg border border-slate-200 bg-white text-base shadow-sm">🇹🇷</span>
                                <span class="whitespace-nowrap truncate max-w-[80px]">TR</span>
                            </a>
                            <a href="{{ route('home', ['lang' => 'en']) }}"
                                class="flex items-center gap-3 rounded-lg px-3 py-2 leading-none transition hover:bg-slate-100 hover:text-slate-900 {{ $currentLocale === 'en' ? 'text-slate-900' : '' }}">
                                <span
                                    class="flex h-7 w-7 items-center justify-center rounded-lg border border-slate-200 bg-white text-base shadow-sm">🇬🇧</span>
                                <span class="whitespace-nowrap truncate max-w-[80px]">EN</span>
                            </a>
                            <a href="{{ route('home', ['lang' => 'es']) }}"
                                class="flex items-center gap-3 rounded-lg px-3 py-2 leading-none transition hover:bg-slate-100 hover:text-slate-900 {{ $currentLocale === 'es' ? 'text-slate-900' : '' }}">
                                <span
                                    class="flex h-7 w-7 items-center justify-center rounded-lg border border-slate-200 bg-white text-base shadow-sm">🇪🇸</span>
                                <span class="whitespace-nowrap truncate max-w-[80px]">ES</span>
                            </a>
                            <a href="{{ route('home', ['lang' => 'fr']) }}"
                                class="flex items-center gap-3 rounded-lg px-3 py-2 leading-none transition hover:bg-slate-100 hover:text-slate-900 {{ $currentLocale === 'fr' ? 'text-slate-900' : '' }}">
                                <span
                                    class="flex h-7 w-7 items-center justify-center rounded-lg border border-slate-200 bg-white text-base shadow-sm">🇫🇷</span>
                                <span class="whitespace-nowrap truncate max-w-[80px]">FR</span>
                            </a>
                            <a href="{{ route('home', ['lang' => 'pt']) }}"
                                class="flex items-center gap-3 rounded-lg px-3 py-2 leading-none transition hover:bg-slate-100 hover:text-slate-900 {{ $currentLocale === 'pt' ? 'text-slate-900' : '' }}">
                                <span
                                    class="flex h-7 w-7 items-center justify-center rounded-lg border border-slate-200 bg-white text-base shadow-sm">🇵🇹</span>
                                <span class="whitespace-nowrap truncate max-w-[80px]">PT</span>
                            </a>
                        </div>
                    </div>
                </details>
            </div>
            <div class="mt-4">
                <a href="{{ route('home') }}#pricing"
                    class="inline-flex w-full items-center justify-center rounded-full bg-slate-900 px-4 py-2 text-xs font-semibold text-white transition hover:bg-slate-800">
                    {{ __('layout.nav.request_demo') }}
                </a>
            </div>
        </div>
    </details>
</nav>
