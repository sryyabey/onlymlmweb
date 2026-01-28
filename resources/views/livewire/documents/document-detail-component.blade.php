<div class="min-h-screen bg-gradient-to-br from-stone-50 via-white to-slate-50">
    <div class="mx-auto max-w-7xl px-6 py-10 lg:px-8">
        <div class="relative overflow-hidden rounded-3xl border border-slate-200 bg-white/80 p-8 shadow-xl backdrop-blur">
            <div class="absolute -right-24 -top-24 h-64 w-64 rounded-full bg-amber-200/40 blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 h-64 w-64 rounded-full bg-sky-200/40 blur-3xl"></div>

            <div class="relative">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                    <div class="space-y-3">
                        <a href="{{ route('documents') }}" class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-500 hover:text-slate-800">
                            ← Dokumantasyona Don
                        </a>
                        <h1 class="text-3xl font-semibold tracking-tight text-slate-900 sm:text-4xl">
                            {{ $content->title }}
                        </h1>
                        <div class="flex flex-wrap items-center gap-2 text-xs text-slate-500">
                            <span>
                                {{ optional($content->published_at)->format('d.m.Y') ?? $content->created_at?->format('d.m.Y') }}
                            </span>
                            @foreach ($content->categories as $contentCategory)
                                <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-medium text-amber-700">
                                    {{ $contentCategory->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($content->tags as $contentTag)
                            <span class="rounded-full border border-slate-200 px-3 py-1 text-xs font-medium text-slate-600">
                                #{{ $contentTag->name }}
                            </span>
                        @endforeach
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
                                @foreach ($categories as $category)
                                    <a
                                        href="{{ route('documents') }}"
                                        class="flex w-full items-center justify-between rounded-xl px-3 py-2 text-left text-sm text-slate-700 transition hover:bg-slate-100"
                                    >
                                        <span>{{ $category->name }}</span>
                                        <span class="text-xs opacity-70">{{ $category->contents_count }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                            <h2 class="text-sm font-semibold text-slate-900">Etiketler</h2>
                            <div class="mt-3 flex flex-wrap gap-2">
                                @foreach ($tags as $tag)
                                    <a
                                        href="{{ route('documents') }}"
                                        class="rounded-full border border-slate-200 px-3 py-1 text-xs font-medium text-slate-600 hover:border-slate-400"
                                    >
                                        #{{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </aside>

                    <section class="space-y-8">
                        @if ($content->image)
                            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-100">
                                <img src="{{ asset('storage/' . $content->image) }}" alt="{{ $content->title }}" class="h-56 w-full object-cover sm:h-72" />
                            </div>
                        @endif

                        @if ($content->excerpt)
                            <p class="text-base font-medium text-slate-600">
                                {{ $content->excerpt }}
                            </p>
                        @endif

                        <article class="prose prose-slate max-w-none content-body">
                            {!! $content->body !!}
                        </article>

                        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                            <h3 class="text-sm font-semibold text-slate-900">Ilgili Dokumanlar</h3>
                            <div class="mt-4 grid gap-3 sm:grid-cols-2">
                                @forelse ($relatedContents as $related)
                                    <a
                                        href="{{ route('documents.show', $related->slug) }}"
                                        class="rounded-2xl border border-slate-200 px-4 py-3 text-sm text-slate-700 transition hover:-translate-y-0.5 hover:border-slate-300 hover:shadow-sm"
                                    >
                                        <div class="font-semibold text-slate-900">{{ $related->title }}</div>
                                        <div class="mt-1 text-xs text-slate-500">
                                            {{ \Illuminate\Support\Str::limit($related->excerpt ?? $related->body, 90) }}
                                        </div>
                                    </a>
                                @empty
                                    <p class="text-sm text-slate-500">Henuz ilgili dokuman bulunamadi.</p>
                                @endforelse
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
