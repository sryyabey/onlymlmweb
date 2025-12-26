<nav class="fixed left-0 right-0 top-0 z-50 mx-auto flex w-full max-w-6xl items-center justify-between border-b border-slate-200 bg-white/90 px-6 py-4 backdrop-blur">
    <a href="{{ route('home') }}">
        <div class="flex items-center gap-3">

            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-900 text-white shadow-sm">
                <img src="{{ asset('img/logo.png') }}" alt="OnlyMLM Logo">
            </div>
            <div>
                <p class="title-font text-lg font-semibold tracking-tight text-slate-900">OnlyMLM</p>
                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Enterprise SaaS</p>
            </div>

        </div>
    </a>
    <div class="hidden items-center gap-8 text-sm text-slate-600 md:flex">
        <a href="{{ route('home') }}#neden-onlymlm"
            class="rounded-full px-3 py-1 transition hover:bg-slate-100 hover:text-slate-900">Neden
            OnlyMLM</a>
        <a href="{{ route('home') }}#ozellikler"
            class="rounded-full px-3 py-1 transition hover:bg-slate-100 hover:text-slate-900">Platform</a>
        <a href="{{ route('home') }}#nasil-calisir"
            class="rounded-full px-3 py-1 transition hover:bg-slate-100 hover:text-slate-900">Nasıl
            Çalışır</a>
        <a href="{{ route('home') }}#fiyat"
            class="rounded-full px-3 py-1 transition hover:bg-slate-100 hover:text-slate-900">Fiyatlandırma</a>
        <a href="{{ route('documents') }}"
            class="rounded-full px-3 py-1 transition hover:bg-slate-100 hover:text-slate-900">Documentation</a>
        <a href="{{ route('home') }}#demo"
            class="rounded-full px-3 py-1 transition hover:bg-slate-100 hover:text-slate-900">Demo</a>
    </div>
    <details class="relative md:hidden">
        <summary
            class="flex items-center gap-2 rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:text-slate-900">
            Menü
            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                    d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.7a.75.75 0 1 1 1.06 1.06l-4.24 4.25a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08Z"
                    clip-rule="evenodd" />
            </svg>
        </summary>
        <div
            class="absolute right-0 z-50 mt-3 w-56 rounded-2xl border border-slate-200 bg-white p-4 text-sm text-slate-600 shadow-lg">
            <div class="flex flex-col gap-1">
                <a href="{{ route('home') }}#neden-onlymlm"
                    class="rounded-lg px-3 py-2 transition hover:bg-slate-100 hover:text-slate-900">Neden
                    OnlyMLM</a>
                <a href="{{ route('home') }}#ozellikler"
                    class="rounded-lg px-3 py-2 transition hover:bg-slate-100 hover:text-slate-900">Platform</a>
                <a href="{{ route('home') }}#nasil-calisir"
                    class="rounded-lg px-3 py-2 transition hover:bg-slate-100 hover:text-slate-900">Nasıl
                    Çalışır</a>
                <a href="{{ route('home') }}#fiyat"
                    class="rounded-lg px-3 py-2 transition hover:bg-slate-100 hover:text-slate-900">Fiyatlandırma</a>
                <a href="{{ route('home') }}#demo"
                    class="rounded-lg px-3 py-2 transition hover:bg-slate-100 hover:text-slate-900">Demo</a>
                <a href="{{ route('documents') }}"
                    class="rounded-lg px-3 py-2 transition hover:bg-slate-100 hover:text-slate-900">Documentation</a>
            </div>
            <div class="mt-4">
                <a href="{{ route('home') }}#demo"
                    class="inline-flex w-full items-center justify-center rounded-full bg-slate-900 px-4 py-2 text-xs font-semibold text-white transition hover:bg-slate-800">
                    Demo Talep Et
                </a>
            </div>
        </div>
    </details>
    <div class="hidden md:block">
        <a href="#demo"
            class="rounded-full bg-slate-900 px-5 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">Demo
            Talep Et</a>
    </div>
</nav>
