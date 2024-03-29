<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white dark:bg-black border border-zinc-300 dark:border-zinc-600 rounded-md text-xs text-zinc-700 dark:text-zinc-300  tracking-widest shadow-sm hover:bg-zinc-100 dark:hover:bg-zinc-800  disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
