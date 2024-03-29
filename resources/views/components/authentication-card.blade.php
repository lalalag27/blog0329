<div class="min-h-screen bg-white dark:bg-black" x-data x-cloak>
    <div
        class="min-h-screen max-w-md mx-auto lg:ml-20  bg-zinc-100 shadow-lg border-zinc-300 border-x dark:border-zinc-600   dark:bg-zinc-900  overflow-hidden">
        <div class="mt-20 px-10 space-y-10">
            <div class="text-sm py-4 bg-amber-400 flex justify-center font-bold rounded">
                {{ $logo }}
            </div>
            {{ $slot }}
            <div class="space-x-6 flex justify-end pt-20 items-center">
                <x-GDcms.copyright class="dark:text-white/60" />
                <x-GDcms.theme-toggle class="w-4" />
            </div>
        </div>


    </div>
</div>
