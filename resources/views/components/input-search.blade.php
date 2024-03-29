@props([
    'disabled' => false,
    'clear' => false,
    'reset' => '',
])


<div class="flex-1">
    <div class="relative">
        <input {{ $disabled ? 'disabled' : '' }}
            {{ $attributes->whereDoesntStartWith('wire:click')->merge([
                'class' =>
                    'w-full  text-zinc-900  focus:border-zinc-800 focus:ring-zinc-900 rounded-lg shadow-sm placeholder:text-black placeholder:text-xs bg-amber-400 text-sm px-12 border border-black',
            ]) }}>


        <div class="absolute left-4 top-[7px]">
            <div class="cursor-pointer text-zinc-900" {{ $attributes->whereStartsWith('wire:click') }}>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 15.75l-2.489-2.489m0 0a3.375 3.375 0 10-4.773-4.773 3.375 3.375 0 004.774 4.774zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
        @if ($clear)
            <div class="absolute right-4 top-[7px]  text-zinc-900">
                <div class="cursor-pointer" x-on:click="{{ $reset }}">
                    <svg xmlns=" http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        @endif
    </div>
</div>
