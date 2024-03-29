@props(['disabled' => false])

<input type="date" onfocus="(this.type='date')" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'border-zinc-300 dark:border-zinc-600 dark:text-zinc-300 focus:border-amber-500 focus:ring-amber-400 rounded-md shadow-sm dark:bg-zinc-700',
]) !!}>

<style>
    input[type='date'] {
        position: relative;
    }

    input[type='date']::-webkit-calendar-picker-indicator {
        position: absolute;
        right: 0;
        padding-left: 100%;
        padding-right: 10px;
        cursor: pointer;
    }

    input[type='date']::-webkit-calendar-picker-indicator:hover {
        opacity: 0.5;
    }

    .dark input[type='date']::-webkit-calendar-picker-indicator {
        filter: invert(1);
    }
</style>
