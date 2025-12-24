<!doctype html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OnlyMLM | Enterprise-Grade MLM & Binary Platform</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --ink: #0b1220;
            --steel: #1d3347;
            --muted: #4c6073;
            --accent: #0ea5a4;
            --accent-dark: #0a7f7d;
            --paper: #f6f8fb;
            --panel: #0f172a;
            --line: #dbe4ee;
        }

        body {
            font-family: "Manrope", system-ui, -apple-system, sans-serif;
            color: var(--ink);
            background: var(--paper);
        }

        .title-font {
            font-family: "Space Grotesk", system-ui, -apple-system, sans-serif;
        }

        .grid-pattern {
            background-image:
                linear-gradient(90deg, rgba(29, 51, 71, 0.08) 1px, transparent 1px),
                linear-gradient(rgba(29, 51, 71, 0.08) 1px, transparent 1px);
            background-size: 36px 36px;
        }
    </style>
</head>

<body class="antialiased">
    <div id="top"></div>
    <div class="relative overflow-hidden">
        <div
            class="absolute -top-32 right-0 h-[520px] w-[520px] rounded-full bg-gradient-to-br from-teal-100 via-white to-transparent blur-3xl opacity-90">
        </div>
        <div
            class="absolute left-0 top-48 h-[420px] w-[420px] rounded-full bg-gradient-to-tr from-slate-100 via-white to-transparent blur-3xl opacity-80">
        </div>

        <header class="relative z-10">
            <nav class="mx-auto flex w-full max-w-6xl items-center justify-between px-6 py-6">
                <div class="flex items-center gap-3">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-900 text-white shadow-sm">
                        <img src="{{ asset('img/logo.png') }}" alt="OnlyMLM Logo">
                    </div>
                    <div>
                        <p class="title-font text-lg font-semibold tracking-tight text-slate-900">OnlyMLM</p>
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Enterprise SaaS</p>
                    </div>
                </div>
                <div class="hidden items-center gap-8 text-sm text-slate-600 md:flex">
                    <a href="#neden-onlymlm" class="rounded-full px-3 py-1 transition hover:bg-slate-100 hover:text-slate-900">Neden OnlyMLM</a>
                    <a href="#ozellikler" class="rounded-full px-3 py-1 transition hover:bg-slate-100 hover:text-slate-900">Platform</a>
                    <a href="#nasil-calisir" class="rounded-full px-3 py-1 transition hover:bg-slate-100 hover:text-slate-900">Nasıl Çalışır</a>
                    <a href="#fiyat" class="rounded-full px-3 py-1 transition hover:bg-slate-100 hover:text-slate-900">Fiyatlandırma</a>
                    <a href="#demo" class="rounded-full px-3 py-1 transition hover:bg-slate-100 hover:text-slate-900">Demo</a>
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
                            <a href="#neden-onlymlm" class="rounded-lg px-3 py-2 transition hover:bg-slate-100 hover:text-slate-900">Neden OnlyMLM</a>
                            <a href="#ozellikler" class="rounded-lg px-3 py-2 transition hover:bg-slate-100 hover:text-slate-900">Platform</a>
                            <a href="#nasil-calisir" class="rounded-lg px-3 py-2 transition hover:bg-slate-100 hover:text-slate-900">Nasıl Çalışır</a>
                            <a href="#fiyat" class="rounded-lg px-3 py-2 transition hover:bg-slate-100 hover:text-slate-900">Fiyatlandırma</a>
                            <a href="#demo" class="rounded-lg px-3 py-2 transition hover:bg-slate-100 hover:text-slate-900">Demo</a>
                        </div>
                        <div class="mt-4">
                            <a href="#demo"
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
        </header>

        <section class="relative  mx-auto w-full max-w-6xl px-6 pb-20 pt-10 md:pt-20">
            <div class="grid gap-12 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-500">Güvenli • Lisanslı •
                        Ölçeklenebilir</p>
                    <h1 class="title-font mt-6 text-4xl font-semibold leading-tight text-slate-900 md:text-5xl">
                        Enterprise-Grade MLM &amp; Binary Platform
                    </h1>
                    <p class="mt-6 text-lg text-slate-600">
                        OnlyMLM, kurumsal büyüme ekipleri için tasarlanmış, regülasyon uyumlu ve yüksek performanslı bir
                        MLM/Binary SaaS altyapısıdır. Lisanslı dağıtım modeli, güvenlik sertifikaları ve entegrasyon
                        katmanı
                        ile “indir-kur” değil, yönetilebilir ve sürdürülebilir bir sistem sunar.
                    </p>
                    <div class="mt-8 flex flex-wrap items-center gap-4">
                        <a href="#demo"
                            class="rounded-full bg-teal-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-teal-700">
                            Kurumsal Demo Talep Et
                        </a>
                        <a href="#ozellikler"
                            class="rounded-full border border-slate-300 px-6 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:text-slate-900">
                            Platformu Keşfet
                        </a>
                    </div>
                    <div class="mt-10 grid grid-cols-2 gap-6 text-sm text-slate-500 md:grid-cols-4">
                        <div>
                            <p class="title-font text-xl font-semibold text-slate-900">%99.95</p>
                            <p>Uptime hedefi</p>
                        </div>
                        <div>
                            <p class="title-font text-xl font-semibold text-slate-900">ISO 27001</p>
                            <p>Güvenlik yaklaşımı</p>
                        </div>
                        <div>
                            <p class="title-font text-xl font-semibold text-slate-900">24/7</p>
                            <p>Uzman destek</p>
                        </div>
                        <div>
                            <p class="title-font text-xl font-semibold text-slate-900">API-first</p>
                            <p>Entegrasyon</p>
                        </div>
                    </div>
                </div>

                <div class="grid gap-6">
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg">
                        <div class="rounded-2xl bg-slate-900 p-5 text-slate-200">
                            <div class="flex items-center justify-between text-xs text-slate-400">
                                <span class="uppercase tracking-[0.2em]">Yönetim Paneli</span>
                                <span>OnlyMLM Ops</span>
                            </div>
                            <div class="mt-4 grid gap-4 lg:grid-cols-[1.2fr_0.8fr]">
                                <div class="rounded-xl bg-slate-800/70 p-4">
                                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Network Health</p>
                                    <p class="mt-2 text-2xl font-semibold text-white">94.6%</p>
                                    <div class="mt-4 grid gap-2 text-xs text-slate-400">
                                        <div class="flex items-center justify-between">
                                            <span>Binary yapı dengesi</span>
                                            <span class="text-emerald-300">+4.1%</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span>Ödeme güvenliği</span>
                                            <span class="text-emerald-300">A+</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span>Aktif lisanslar</span>
                                            <span>128</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="rounded-xl bg-slate-950 p-4">
                                    <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Gerçek Zamanlı</p>
                                    <p class="mt-2 text-lg font-semibold text-white">Gelir Akışı</p>
                                    <div
                                        class="mt-4 h-24 rounded-lg bg-gradient-to-t from-teal-600/40 via-slate-800 to-slate-900 p-2">
                                        <div class="h-full w-full rounded-lg border border-slate-700/70"></div>
                                    </div>
                                    <p class="mt-3 text-xs text-slate-400">Kural tabanlı komisyon izleme</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Network Topolojisi</p>
                                <p class="title-font mt-2 text-lg font-semibold text-slate-900">Binary &amp; MLM
                                    Diyagramı</p>
                            </div>
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs text-slate-600">Kurumsal
                                görünüm</span>
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
                                <span>Şeffaf kayıt</span>
                                <span>Şube dengesi</span>
                                <span>Denetlenebilir kurallar</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <section id="neden-onlymlm" class="grid-pattern border-y border-slate-200 bg-white">
        <div class="mx-auto w-full max-w-6xl px-6 py-20">
            <div class="grid gap-10 lg:grid-cols-[1fr_1.1fr] lg:items-center">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-500">Neden OnlyMLM</p>
                    <h2 class="title-font mt-4 text-3xl font-semibold text-slate-900 md:text-4xl">MLM mühendisliği için
                        kurumsal yaklaşım</h2>
                </div>
                <p class="text-lg text-slate-600">
                    OnlyMLM, karmaşık binary ağaçlarını otomatik dengeleyebilen, lisans ve komisyon kurallarını
                    denetlenebilir hale getiren bir SaaS platformudur. Regülasyon uyumu, audit log altyapısı ve
                    ölçeklenebilir bulut mimarisi sayesinde operasyonel riskleri en baştan minimize eder.
                </p>
            </div>
            <div class="mt-12 grid gap-6 md:grid-cols-3">
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
                    <p class="title-font text-lg font-semibold text-slate-900">Kurumsal Güvenlik</p>
                    <p class="mt-3 text-sm text-slate-600">Lisanslı erişim, rol bazlı yetkilendirme ve şifreli veri
                        akışı.</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
                    <p class="title-font text-lg font-semibold text-slate-900">Sürdürülebilir Ölçek</p>
                    <p class="mt-3 text-sm text-slate-600">Modüler altyapı ile yeni ülkeler ve ekipler için hızlı
                        yayılım.</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
                    <p class="title-font text-lg font-semibold text-slate-900">Operasyonel Şeffaflık</p>
                    <p class="mt-3 text-sm text-slate-600">Gerçek zamanlı raporlama ve denetlenebilir komisyon
                        hesapları.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="ozellikler" class="mx-auto w-full max-w-6xl px-6 py-20">
        <div class="flex flex-wrap items-end justify-between gap-6">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-500">Platform Özellikleri</p>
                <h2 class="title-font mt-4 text-3xl font-semibold text-slate-900 md:text-4xl">Tek platform, çoklu
                    kabiliyet</h2>
            </div>
            <p class="max-w-xl text-sm text-slate-600">
                MLM/Binary motoru, Bagisto e-ticaret entegrasyonu ve API katmanı; lisanslı model, güvenlik ve performans
                odağında tek bir mimaride birleşir.
            </p>
        </div>
        <div class="mt-12 grid gap-6 md:grid-cols-2">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-teal-600 text-white">ML</span>
                    <div>
                        <p class="title-font text-lg font-semibold text-slate-900">MLM / Binary Motoru</p>
                        <p class="text-sm text-slate-500">Kural tabanlı komisyon, otomatik denge ve performans
                            optimizasyonu.</p>
                    </div>
                </div>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center gap-3">
                    <span
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-900 text-white">BG</span>
                    <div>
                        <p class="title-font text-lg font-semibold text-slate-900">Bagisto E-Ticaret</p>
                        <p class="text-sm text-slate-500">Lisanslı mağaza altyapısı, ürün ve ödeme yönetimiyle entegre.
                        </p>
                    </div>
                </div>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center gap-3">
                    <span
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-700 text-white">LC</span>
                    <div>
                        <p class="title-font text-lg font-semibold text-slate-900">Lisanslama Katmanı</p>
                        <p class="text-sm text-slate-500">Süre, ülke ve kullanıcı bazlı lisans yönetimi ve compliance.
                        </p>
                    </div>
                </div>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center gap-3">
                    <span
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-teal-700 text-white">API</span>
                    <div>
                        <p class="title-font text-lg font-semibold text-slate-900">API &amp; Entegrasyon</p>
                        <p class="text-sm text-slate-500">CRM, ödeme ve ERP sistemleriyle güvenli entegrasyon.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="nasil-calisir" class="border-y border-slate-200 bg-white">
        <div class="mx-auto w-full max-w-6xl px-6 py-20">
            <div class="grid gap-8 lg:grid-cols-[1fr_1.1fr]">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-500">Nasıl Çalışır</p>
                    <h2 class="title-font mt-4 text-3xl font-semibold text-slate-900 md:text-4xl">Net süreç, kontrollü
                        yayılım</h2>
                </div>
                <p class="text-lg text-slate-600">
                    Süreçler “indir-kur” değil, lisanslı ve güvenlik kontrollü bir devreye alma modeline dayanır.
                    Her adımda teknik ekiplerinize eşlik ediyor, altyapıyı ölçeklenebilir hale getiriyoruz.
                </p>
            </div>
            <div class="mt-12 grid gap-6 md:grid-cols-3">
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
                    <p class="title-font text-lg font-semibold text-slate-900">1. Lisanslı Satın Alım</p>
                    <p class="mt-3 text-sm text-slate-600">Kurumsal lisanslama, kapsam ve SLA hedefleri netleşir.</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
                    <p class="title-font text-lg font-semibold text-slate-900">2. Kurulum &amp; Migrasyon</p>
                    <p class="mt-3 text-sm text-slate-600">Veri taşınır, erişimler tanımlanır, güvenlik kontrolleri
                        tamamlanır.</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
                    <p class="title-font text-lg font-semibold text-slate-900">3. Yayına Alma</p>
                    <p class="mt-3 text-sm text-slate-600">Performans izleme, eğitim ve sürekli iyileştirme devreye
                        girer.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="fiyat" class="mx-auto w-full max-w-6xl px-6 py-20">
        <div class="text-center">
            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-500">Şeffaf Fiyatlandırma</p>
            <h2 class="title-font mt-4 text-3xl font-semibold text-slate-900 md:text-4xl">İşletmenize uygun lisans
                modeli</h2>
            <p class="mt-4 text-lg text-slate-600">Sözleşme, SLA ve güvenlik kapsamı net. Gizli maliyet yok.</p>
        </div>
        <div class="mt-12 grid gap-6 lg:grid-cols-3">
            <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Core</p>
                <p class="title-font mt-3 text-2xl font-semibold text-slate-900">Başlangıç</p>
                <p class="title-font mt-2 text-3xl font-semibold text-slate-900">$4,900</p>
                <p class="text-xs text-slate-500">aylık lisans</p>
                <p class="mt-2 text-sm text-slate-600">Yeni operasyonlar için temel kurulum ve destek.</p>
                <ul class="mt-6 space-y-3 text-sm text-slate-600">
                    <li>MLM/Binary motoru</li>
                    <li>Temel raporlama</li>
                    <li>Standart SLA</li>
                </ul>
            </div>
            <div class="rounded-2xl border border-slate-900 bg-slate-900 p-8 text-white shadow-lg">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-300">Enterprise</p>
                <p class="title-font mt-3 text-2xl font-semibold">Kurumsal</p>
                <p class="title-font mt-2 text-3xl font-semibold">$12,900</p>
                <p class="text-xs text-slate-300">aylık lisans</p>
                <p class="mt-2 text-sm text-slate-200">Global ekipler ve yüksek hacimli operasyonlar.</p>
                <ul class="mt-6 space-y-3 text-sm text-slate-200">
                    <li>Gelişmiş denetim &amp; audit log</li>
                    <li>Bagisto entegrasyonu</li>
                    <li>Öncelikli destek</li>
                </ul>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Custom</p>
                <p class="title-font mt-3 text-2xl font-semibold text-slate-900">Özel</p>
                <p class="title-font mt-2 text-3xl font-semibold text-slate-900">$24,900+</p>
                <p class="text-xs text-slate-500">aylık lisans</p>
                <p class="mt-2 text-sm text-slate-600">Regülasyon ve entegrasyon ihtiyaçlarına özel.</p>
                <ul class="mt-6 space-y-3 text-sm text-slate-600">
                    <li>API &amp; ERP entegrasyonu</li>
                    <li>Özel güvenlik kontrolleri</li>
                    <li>Yerinde danışmanlık</li>
                </ul>
            </div>
        </div>
    </section>

    <section id="demo" class="border-t border-slate-200 bg-white">
        <div class="mx-auto w-full max-w-6xl px-6 py-20">
            <div class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-500">Demo</p>
                    <h2 class="title-font mt-4 text-3xl font-semibold text-slate-900 md:text-4xl">Kurumsal demo isteyin
                    </h2>
                    <p class="mt-4 text-lg text-slate-600">
                        Lisanslı ve güvenli OnlyMLM altyapısını operasyonunuza uygun şekilde birlikte tasarlayalım.
                        Demo oturumunda güvenlik, performans ve entegrasyon yeteneklerini detaylı olarak gösteriyoruz.
                    </p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                    <form class="grid gap-4">
                        <input
                            class="rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-teal-600 focus:outline-none"
                            placeholder="Şirket adı">
                        <input
                            class="rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-teal-600 focus:outline-none"
                            placeholder="Kurumsal e-posta">
                        <input
                            class="rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-teal-600 focus:outline-none"
                            placeholder="Operasyon ölçeği (ülke / ekip)">
                        <button type="button"
                            class="rounded-xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                            Demo Talep Et
                        </button>
                        <p class="text-xs text-slate-500">Başvurular 24 saat içinde teknik ekip tarafından geri dönüş
                            alır.</p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="border-t border-slate-200 bg-slate-950 text-slate-300">
        <div class="mx-auto w-full max-w-6xl px-6 py-12">
            <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="title-font text-xl font-semibold text-white">OnlyMLM</p>
                    <p class="mt-2 text-sm text-slate-400">Enterprise seviyede MLM &amp; Binary SaaS altyapısı.</p>
                </div>
                <div class="flex flex-wrap gap-6 text-sm">
                    <span>Lisanslı kullanım</span>
                    <span>Güvenlik odaklı</span>
                    <span>Ölçeklenebilir mimari</span>
                </div>
            </div>
            <p class="mt-8 text-xs text-slate-500">© 2024 OnlyMLM. Tüm hakları saklıdır.</p>
        </div>
    </footer>

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
