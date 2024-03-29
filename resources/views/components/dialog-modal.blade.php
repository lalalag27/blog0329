@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        @if (isset($title))
            <div class="text-lg font-medium text-zinc-900 dark:text-zinc-100">
                {{ $title }}
            </div>
        @endif

        @if (isset($content))
            <div class="mt-4 text-sm text-zinc-600 dark:text-zinc-300">
                {{ $content }}
            </div>
        @endif
    </div>

    @if (isset($footer))
        <div class="flex flex-row justify-end px-6 py-4 text-right bg-zinc-100 dark:bg-zinc-900">
            {{ $footer }}
        </div>
    @endif
</x-modal>
