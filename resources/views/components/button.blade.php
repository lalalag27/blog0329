<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'hover:ring-1 hover:ring-black hover:dark:ring-amber-300 inline-flex items-center px-4 py-2 bg-amber-400 rounded-md font-semibold text-xs text-black uppercase tracking-widest transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
