@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'dark:read-only:bg-zinc-800 read-only:bg-zinc-300 border-zinc-300 dark:border-zinc-600 dark:text-zinc-300 bg-white/50 focus:border-amber-500 focus:ring-amber-400 rounded-md shadow-sm dark:bg-zinc-800/20',
]) !!} x-mask="99999">
