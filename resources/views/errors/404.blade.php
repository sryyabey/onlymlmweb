<!doctype html>
<html lang="tr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>404 | Sayfa Bulunamadı</title>
        @vite('resources/css/app.css')
    </head>
    <body class="min-h-screen bg-slate-950 text-slate-100">
        <main class="relative min-h-screen overflow-hidden">
            <div class="absolute inset-0">
                <div class="absolute -top-24 left-1/2 h-80 w-80 -translate-x-1/2 rounded-full bg-amber-500/20 blur-3xl"></div>
                <div class="absolute bottom-0 left-0 h-96 w-96 -translate-x-1/3 translate-y-1/3 rounded-full bg-rose-500/20 blur-3xl"></div>
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(180,83,9,0.2),_transparent_55%)]"></div>
            </div>

            <section class="relative mx-auto flex min-h-screen max-w-5xl flex-col items-start justify-center px-6 py-16">
                <span class="inline-flex items-center gap-2 rounded-full border border-amber-400/30 bg-amber-500/10 px-4 py-1 text-sm font-semibold tracking-wide text-amber-200">
                    Yanlış Bir Adres
                </span>
                <h1 class="mt-6 text-4xl font-semibold tracking-tight text-white sm:text-5xl">
                    404 — Aradığın sayfa bulunamadı
                </h1>
                <p class="mt-4 max-w-2xl text-lg text-slate-200/80">
                    Bağlantı bozuk olabilir veya sayfa taşınmış olabilir. 
                    Ana sayfaya dönüp tekrar deneyebilirsin.
                </p>

                <div class="mt-8 flex flex-wrap gap-4">
                    <a
                        href="{{ url('/') }}"
                        class="inline-flex items-center justify-center rounded-full bg-amber-400 px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-amber-300"
                    >
                        Ana sayfaya dön
                    </a>
                    <a
                        href="{{ url()->previous() }}"
                        class="inline-flex items-center justify-center rounded-full border border-slate-600/60 px-6 py-3 text-sm font-semibold text-slate-100 transition hover:border-slate-400/60 hover:text-white"
                    >
                        Geri git
                    </a>
                </div>

                <div class="mt-10 grid w-full max-w-3xl gap-6 rounded-2xl border border-white/10 bg-white/5 p-6 sm:grid-cols-2">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-amber-300/80">
                            Öneri
                        </p>
                        <p class="mt-3 text-base text-slate-200">
                            URL doğruluğunu kontrol edin veya arama kullanın.
                        </p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-amber-300/80">
                            Yardım
                        </p>
                        <p class="mt-3 text-base text-slate-200">
                            Destek ekibimiz size yardımcı olmaya hazır.
                        </p>
                    </div>
                </div>

                <p class="mt-10 text-sm text-slate-400">
                    İletişim: 
                    <span class="text-slate-200">support@onlymlm.com</span>
                </p>
            </section>
        </main>
    </body>
</html>
