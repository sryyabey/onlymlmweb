<div class="min-h-screen bg-gradient-to-br from-stone-50 via-white to-slate-50">
    <div class="mx-auto max-w-7xl px-6 py-10 lg:px-8">
        <div class="relative overflow-hidden rounded-3xl border border-slate-200 bg-white/80 p-8 shadow-xl backdrop-blur">
            <div class="absolute -right-24 -top-24 h-64 w-64 rounded-full bg-amber-200/40 blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 h-64 w-64 rounded-full bg-sky-200/40 blur-3xl"></div>

            <div class="relative">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                    <div class="space-y-2">
                        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-500">Documentation Hub</p>
                        <h1 class="text-3xl font-semibold tracking-tight text-slate-900 sm:text-4xl">
                            Proje Dokumantasyonu
                        </h1>
                        <p class="max-w-2xl text-sm text-slate-600 sm:text-base">
                            Moduller, senaryolar ve uygulama gelistirme notlari tek yerde. Kategori secerek ilerleyin veya arama ile hizli bulun.
                        </p>
                    </div>
                    <div class="w-full max-w-md">
                        <label class="text-xs font-medium uppercase tracking-[0.2em] text-slate-500">Ara</label>
                        <div class="mt-2 flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-3 shadow-sm focus-within:border-slate-900 focus-within:ring-2 focus-within:ring-slate-200">
                            <span class="text-slate-400">🔎</span>
                            <input
                                type="search"
                                wire:model.debounce.400ms="search"
                                placeholder="API, kurulum, entegrasyon..."
                                class="w-full border-0 bg-transparent text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none"
                            />
                        </div>
                    </div>
                </div>

                <div class="mt-10 grid gap-8 lg:grid-cols-[260px_1fr]">
                    <aside class="space-y-6">
                        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                            <div class="flex items-center justify-between">
                                <h2 class="text-sm font-semibold text-slate-900">Kategoriler</h2>
                                <span class="text-xs text-slate-400">{{ $categories->count() }}</span>
                            </div>
                            <div class="mt-4 space-y-2">
                                <button
                                    type="button"
                                    wire:click="$set('categoryId', null)"
                                    class="{{ $categoryId === null ? 'bg-slate-900 text-white' : 'text-slate-700 hover:bg-slate-100' }} flex w-full items-center justify-between rounded-xl px-3 py-2 text-left text-sm transition"
                                >
                                    <span>Tumu</span>
                                    <span class="text-xs opacity-70">{{ $contents->count() }}</span>
                                </button>
                                @foreach ($categories as $category)
                                    <button
                                        type="button"
                                        wire:click="$set('categoryId', {{ $category->id }})"
                                        class="{{ $categoryId === $category->id ? 'bg-slate-900 text-white' : 'text-slate-700 hover:bg-slate-100' }} flex w-full items-center justify-between rounded-xl px-3 py-2 text-left text-sm transition"
                                    >
                                        <span>{{ $category->name }}</span>
                                        <span class="text-xs opacity-70">{{ $category->contents_count }}</span>
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                            <div class="flex items-center justify-between">
                                <h2 class="text-sm font-semibold text-slate-900">Etiketler</h2>
                                <button
                                    type="button"
                                    wire:click="$set('tagId', null)"
                                    class="text-xs font-medium text-slate-500 hover:text-slate-900"
                                >
                                    Sifirla
                                </button>
                            </div>
                            <div class="mt-3 flex flex-wrap gap-2">
                                @foreach ($tags as $tag)
                                    <button
                                        type="button"
                                        wire:click="$set('tagId', {{ $tag->id }})"
                                        class="{{ $tagId === $tag->id ? 'bg-slate-900 text-white' : 'border border-slate-200 text-slate-600 hover:border-slate-400' }} rounded-full px-3 py-1 text-xs font-medium transition"
                                    >
                                        #{{ $tag->name }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </aside>

                    <section class="space-y-6">
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <div class="flex items-center gap-3 text-sm text-slate-600">
                                <span class="font-semibold text-slate-900">{{ $contents->count() }}</span>
                                <span>icerik bulundu</span>
                                @if ($search)
                                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs text-slate-600">
                                        Arama: "{{ $search }}"
                                    </span>
                                @endif
                            </div>
                            <button
                                type="button"
                                wire:click="$set('search', '')"
                                class="rounded-full border border-slate-200 px-4 py-1 text-xs font-medium text-slate-600 hover:border-slate-400 hover:text-slate-900"
                            >
                                Aramayi temizle
                            </button>
                        </div>

                        <div class="grid gap-4">
                            @forelse ($contents as $content)
                                <article class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                                    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                                        <div class="space-y-3">
                                            <h3 class="text-lg font-semibold text-slate-900 group-hover:text-slate-950">
                                                <a href="{{ route('documents.show', $content->slug) }}" class="hover:underline">
                                                    {{ $content->title }}
                                                </a>
                                            </h3>
                                            <p class="text-sm leading-6 text-slate-600">
                                                {!! \Illuminate\Support\Str::limit($content->excerpt ?? $content->body, 180) !!}
                                            </p>
                                            <div class="flex flex-wrap gap-2">
                                                @foreach ($content->categories as $contentCategory)
                                                    <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-medium text-amber-700">
                                                        {{ $contentCategory->name }}
                                                    </span>
                                                @endforeach
                                                @foreach ($content->tags as $contentTag)
                                                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">
                                                        #{{ $contentTag->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2 text-xs text-slate-400">
                                            <span>Guncelleme</span>
                                            <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                                            <span>
                                                {{ optional($content->published_at)->format('d.m.Y') ?? $content->created_at?->format('d.m.Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </article>
                            @empty
                                <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center">
                                    <p class="text-sm font-medium text-slate-600">Bu filtrelerle goruntulenecek icerik yok.</p>
                                    <p class="mt-2 text-xs text-slate-400">Farkli bir kategori ya da arama deneyin.</p>
                                </div>
                            @endforelse
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
