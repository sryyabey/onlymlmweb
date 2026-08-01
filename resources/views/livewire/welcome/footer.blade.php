<footer class="border-t border-slate-200 bg-slate-950 text-slate-300">
    <div class="mx-auto w-full max-w-6xl px-6 py-12">
        <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="title-font text-xl font-semibold text-white">OnlyMLM</p>
                <p class="mt-2 text-sm text-slate-400">{{ __('layout.footer.description') }}</p>
            </div>
            <div class="flex flex-wrap gap-6 text-sm">
                <span>{{ __('layout.footer.licensed') }}</span>
                <span>{{ __('layout.footer.security') }}</span>
                <span>{{ __('layout.footer.scalable') }}</span>
            </div>
        </div>
        <p class="mt-8 text-xs text-slate-500">© {{ now()->year }} OnlyMLM. {{ __('layout.footer.rights') }}</p>
    </div>
</footer>
