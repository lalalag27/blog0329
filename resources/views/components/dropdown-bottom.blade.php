@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white dark:bg-black', 'dropdownClasses' => ''])

@php
    switch ($align) {
        case 'left':
            $alignmentClasses = 'origin-top-left left-0';
            break;
        case 'top':
            $alignmentClasses = 'origin-top';
            break;
        case 'none':
        case 'false':
            $alignmentClasses = '';
            break;
        case 'right':
        default:
            $alignmentClasses = 'origin-top-right right-0';
            break;
    }
    
    switch ($width) {
        case '48':
            $width = 'w-48';
            break;
    }
@endphp

<div x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div class="fixed inset-0 z-50 backdrop-blur" x-show="open" x-cloak>
        <div class="absolute inset-0 bg-zinc-800 opacity-70" @click="open = false"></div>
        <div x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="fixed bottom-0 left-0 z-50 w-full p-10 bg-white shadow-lg dark:bg-black" @click="open = false">
            <div class="py-10 mx-auto space-y-10 text-xl max-w-7xl">
                {{ $content }}
            </div>
        </div>
    </div>
</div>
