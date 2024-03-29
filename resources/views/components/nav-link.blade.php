@props(['active'])

@php
    $classes = $active ?? false ? 'inline-flex items-center px-1 pt-1 border-b-2 border-amber-400 text-sm font-bold leading-5 text-zinc-900 dark:text-zinc-100 focus:outline-none focus:border-amber-500 transition duration-150 ease-in-out' : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-bold leading-5 text-zinc-500 hover:text-zinc-900 dark:hover:text-zinc-300 hover:border-amber-400  focus:outline-none focus:text-zinc-700 focus:border-zinc-300 transition duration-150 ease-in-out';
@endphp

<div>
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
</div>
