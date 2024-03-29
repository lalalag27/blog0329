@php
    $AppMenu = new App\Livewire\Backend\Share\Header();
    $menu = $AppMenu->menu;
@endphp
<div>
    <!-- 網頁標題，展開按鈕等... -->
    <header class="sticky top-0 w-full bg-amber-400 text-zinc-900">
        <section class="flex items-center justify-between max-w-screen-xl px-6 py-2 mx-auto">
            <!-- 展開選單跟標題 -->
            <livewire:backend.share.header />
        </section>
    </header>

    <div class="py-6" x-data>
        <div class="max-w-screen-sm mx-auto">
            <div class="px-6 my-10 space-y-2">
                <p>Hi，{{ Auth::user()->email }}</p>
                <p class="text-sm">歡迎使用網站管理系統</p>
            </div>
            <!-- 選單 -->
            <div class="grid grid-cols-2 gap-10 px-6">
                @foreach ($menu as $item)
                    @if ($item['routeName'] != 'profile.show' && $item['showMenu'] != false)
                        <a href="{{ route($item['routeName']) }}"
                            class="p-6 text-sm text-center transition-all bg-white border rounded dark:bg-zinc-800 dark:border-zinc-600 dark:hover:border-amber-400 hover:border-amber-400">
                            {{ $item['title'] }}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
