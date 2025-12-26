<!doctype html>
<html lang="tr">

@include('livewire.welcome.header')

<body class="antialiased pt-24">
    <div id="top"></div>
    <div class="relative overflow-hidden">
        <div
            class="absolute -top-32 right-0 h-[520px] w-[520px] rounded-full bg-gradient-to-br from-teal-100 via-white to-transparent blur-3xl opacity-90">
        </div>
        <div
            class="absolute left-0 top-48 h-[420px] w-[420px] rounded-full bg-gradient-to-tr from-slate-100 via-white to-transparent blur-3xl opacity-80">
        </div>

        <header class="relative z-10">
            @include('livewire.welcome.navigation')
        </header>
        @yield('hero')

    </div>

    @yield('content')

    @include('livewire.welcome.footer')

    <a href="#top"
        class="fixed bottom-6 right-6 z-40 inline-flex h-12 w-12 items-center justify-center rounded-full bg-slate-900 text-white shadow-lg transition hover:bg-slate-800"
        aria-label="Yukarı çık">
        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd"
                d="M10 4a.75.75 0 0 1 .53.22l4.25 4.25a.75.75 0 1 1-1.06 1.06L10.75 6.56V16a.75.75 0 0 1-1.5 0V6.56L6.28 9.53a.75.75 0 1 1-1.06-1.06l4.25-4.25A.75.75 0 0 1 10 4Z"
                clip-rule="evenodd" />
        </svg>
    </a>
</body>

</html>
