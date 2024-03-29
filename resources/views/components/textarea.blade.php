@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'border-zinc-300 dark:border-zinc-600 dark:text-zinc-300 focus:border-amber-500 focus:ring-amber-400 rounded-md shadow-sm dark:bg-zinc-700',
]) !!}>{{ $slot }}</textarea>
