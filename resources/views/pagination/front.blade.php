<div class="py-10">
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
            <!--prev-->
            <span class="flex items-center">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="text-zinc-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </span>
                @else
                    <button wire:click='previousPage' wire:loading.attr="disabled" rel="prev"
                        x-on:click="scrollTo({top: 0, behavior: 'smooth'})"
                        class="transition-all cursor-pointer hover:bg-amber-400 hover:rounded hover:text-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                @endif
            </span>

            <!--elements-->
            <span class="items-center hidden px-4 sm:flex">
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span aria-disabled="true">
                            <span
                                class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium leading-5 cursor-default">
                                {{ $element }}
                            </span>
                        </span>
                    @endif


                    @if (is_array($element))
                        <ul class="grid grid-flow-col-dense gap-x-6">
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span class="p-2 rounded cursor-pointer bg-amber-400 dark:text-black"
                                        wire:click='gotoPage({{ $page }})'
                                        x-on:click="$wire.selectPage = false,$wire.selectAll = false,scrollTo({top: 0, behavior: 'smooth'})">
                                        {{ $page }}
                                    </span>
                                @else
                                    <li class="p-2 transition-all rounded cursor-pointer hover:bg-amber-400 dark:hover:text-black"
                                        wire:click='gotoPage({{ $page }})'
                                        x-on:click="$wire.selectPage = false,$wire.selectAll = false,scrollTo({top: 0, behavior: 'smooth'})">
                                        {{ $page }}
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                @endforeach
            </span>

            <!--next-->
            <span class="flex items-center">
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <button wire:click='nextPage,$wire.$refresh' wire:loading.attr="disabled" rel="next"
                        x-on:click="scrollTo({top: 0, behavior: 'smooth'})"
                        class="transition-all cursor-pointer hover:bg-amber-400 hover:rounded hover:text-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                @else
                    <button class="text-zinc-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                @endif
            </span>
        </nav>

        <!-- Dialog Loading -->
        <section class="fixed inset-0 z-50" wire:loading wire:target="gotoPage,previousPage,nextPage">
            <div class='grid w-full h-full place-content-center'>
                <svg class="w-20 h-20 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </div>
        </section>
    @endif
</div>
