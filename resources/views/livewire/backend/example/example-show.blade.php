{{-- 有標x-show的有需要再改成true就好 --}}
<div x-data>
    <!-- 1.全局操作跟頁面標題 判斷有沒有使用$search顯示不同Header -->
    @if (isset($search))
        <header class="sticky top-0 z-10 w-full bg-amber-400 text-zinc-900">
            <!-- 標題、搜尋Bar、篩選 -->
            <section class="flex items-center justify-between max-w-screen-xl px-6 py-2 mx-auto">
                <!-- 展開選單跟標題 -->
                <livewire:backend.share.header />
                <!-- 搜尋跟篩選 -->
                <section>
                    <div class="flex items-center justify-end lg:justify-center">
                        <div class="items-center hidden w-full max-w-lg lg:flex">
                            <x-input-search clear="{{ $search ? true : false }}" reset="$wire.goRest('search')"
                                placeholder="搜尋關鍵字..." wire:model="search" wire:keydown.enter="goSearch()"
                                wire:click="goSearch()" name="search" autocomplete="off" />
                            <button type="button" class="pl-2 text-xs font-bold underline"
                                wire:click="$set('showFilter',true)">篩選</button>
                        </div>
                        <!-- 手機板搜尋 -->
                        <button type="button" class="block px-2 lg:hidden" wire:click="$set('showFilter',true)">
                            <x-Icons.search />
                        </button>
                    </div>
                </section>
            </section>

            <!-- 全選跟批量操作及排序方式選擇 -->
            <section class="bg-white shadow dark:bg-zinc-950 text-zinc-900 dark:text-zinc-300 ">
                <div class="px-6 py-2 mx-auto max-w-7xl">
                    <section class="flex justify-between py-2">
                        <div class="flex items-center space-x-2">
                            <x-checkbox name="selectedPage" wire:model.live="selectedPage" />
                            <div class="text-xs">全選</div>
                        </div>
                        <!-- 選擇排序方式 -->
                        <x-select-sort wire:model='orderByItems' />
                    </section>

                    <!-- 全選後跳出批量操作 -->
                    @if ($selected && count($selected) > 0)
                        <section
                            class="flex items-center justify-between p-4 my-2 text-sm rounded sm:justify-start sm:space-x-6 dark:bg-zinc-800 bg-zinc-100 ">
                            <div>已選取：{{ count($selected) }}</div>
                            <div wire:click="$set('selectedAll',true)"
                                class="@if ($selectedAll) text-red-500 @endif underline cursor-pointer tracking-widest underline-offset-2">
                                選取全部資料
                            </div>
                            <x-secondary-button wire:click="$set('showBulkAll',true)" class="min-w-fit">
                                選擇操作
                            </x-secondary-button>
                        </section>
                    @endif
                </div>
            </section>

            <!-- 篩選及搜尋結果 -->
            @if ($search or $startDate or $endDate or $statusActive !== null && $statusActive !== '')
                <ul class="bg-white dark:bg-black">
                    <li class="flex items-center max-w-screen-xl px-6 py-4 mx-auto space-x-4">
                        <h2 class="text-sm dark:text-zinc-300 text-zinc-900">篩選條件</h2>
                        <x-button class="flex items-center space-x-2 min-w-fit" x-show="$wire.search"
                            wire:click="goRest('search')" name="search">
                            <p>搜尋:{{ $search }}</p>
                            <p>x</p>
                        </x-button>
                        <x-secondary-button class="min-w-fit" x-show="$wire.startDate"
                            wire:click="$set('showFilter',true)">
                            開始日期:{{ $startDate }}
                        </x-secondary-button>
                        <x-secondary-button class="min-w-fit" x-show="$wire.endDate"
                            wire:click="$set('showFilter',true)">
                            結束日期:{{ $endDate }}
                        </x-secondary-button>
                        <x-secondary-button class="min-w-fit" x-show="$wire.statusActive"
                            wire:click="$set('showFilter',true)">
                            狀態:{{ $statusActive ? '啟用' : '關閉' }}
                        </x-secondary-button>
                    </li>
                </ul>
            @endif
        </header>
    @else
        <header class="sticky top-0 z-10 w-full bg-amber-400 text-zinc-900">
            <section class="flex items-center justify-between max-w-screen-xl px-6 py-2 mx-auto">
                <livewire:backend.share.header />
            </section>
        </header>
    @endif

    <!-- 2.其他頁面選單 -->
    @if (isset($childPages))
        <section class="max-w-screen-xl px-6 pt-10 mx-auto">
            <x-Gdcms.child-pages :childPages="$childPages" :currentRouteName="$currentRouteName" />
        </section>
    @endif


    <!-- 3.新增按鈕 -->
    <section class="max-w-screen-xl px-6 py-10 mx-auto" x-show="true">
        <a href="{{ route('admin-example.edit', 'add') }}">
            <x-button type="button">
                新增
            </x-button>
        </a>
    </section>


    <!-- 4.列表 -->
    <section x-show="true">
        <div class="px-6 mx-auto space-y-10 max-w-7xl">
            <div class="space-y-2">
                @forelse ($examples as $example)
                    <div wire:key="{{ $example->id }}"
                        class="p-6 bg-white rounded dark:bg-black hover:ring-1 hover:ring-amber-400">
                        <div class="items-center justify-between lg:flex">
                            <!-- 列表 -->
                            <section class="items-center flex-1 w-full space-y-10 lg:space-y-0 lg:space-x-10 lg:flex">
                                <!-- 選取-->
                                <section x-show="true">
                                    <div class="flex items-center space-x-2 lg:block lg:space-x-0">
                                        <x-checkbox name="selected" wire:model.live="selected"
                                            value="{{ $example->id }}" />
                                        <div class="text-sm lg:hidden">選取</div>
                                    </div>
                                </section>


                                <!-- 圖片-->
                                <div class="w-full lg:w-24" x-show="false">
                                    <div class="relative pt-[100%]">
                                        <!-- 如果有多張圖片使用 App\Livewire\Backend\Traits\GetImgUrl\WithGetImgUrl -->
                                        <!-- 多張請加上first()如果image_path沒有圖片使用??null就會回傳預設圖片 -->
                                        <img src="{{ self::getImageUrl($example->exampleImage()->orderBy('order_num', 'ASC')->first()->image_path ?? null) }}"
                                            alt=""
                                            class="absolute top-0 left-0 object-cover w-full h-full border rounded dark:border-zinc-600">
                                    </div>
                                </div>

                                <!-- 內容 -->
                                <section class="w-48 max-w-full space-y-2" x-show="true">
                                    <p class="text-xs">{{ $example->created_at->format('Y.m.d') }}</p>
                                    <p class="font-bold">{{ $example->title }}<sup class="px-1">標題</sup></p>
                                </section>

                                <!-- 項目按鈕列 -->
                                <section x-show="true"
                                    class="flex w-full p-2 space-x-6 overflow-hidden overflow-x-auto lg:hover:overflow-x-auto lg:max-w-lg xl:max-w-2xl touch-auto ">

                                    <!-- 狀態開關 -->
                                    <x-secondary-button type="button" x-show="true" class="min-w-fit"
                                        wire:click="toggleActive({{ $example->id }})"
                                        class="{{ $example->is_active ? '' : 'bg-zinc-300 dark:bg-zinc-800' }}">
                                        啟用狀態:{{ $example->is_active ? '開啟' : '關閉' }}
                                    </x-secondary-button>

                                    <!-- 排序 -->
                                    <x-button type="button" x-show="true" class="min-w-fit"
                                        wire:click="openOrderNumEditDialog({{ $example->id }})">
                                        排序:{{ $example->order_num }}
                                    </x-button>

                                    <!-- id觀看 debug的時候打開 -->
                                    <x-secondary-button type="button" x-show="false" class="min-w-fit">
                                        id:{{ $example->id }}
                                    </x-secondary-button>

                                    <!-- 分類 -->
                                    @if ($example->exampleCategory->count() > 0)
                                        <x-secondary-button type="button" x-show="true" class="min-w-fit">
                                            <ul class="flex items-center">
                                                分類:
                                                <li class="px-1">
                                                    {{ $example->exampleCategory->title }}
                                                </li>
                                            </ul>
                                        </x-secondary-button>
                                    @endif
                                </section>
                            </section>

                            <!-- 操作選單 -->
                            <section class="my-6 lg:my-0" x-show="true">
                                <x-dropdown-bottom>
                                    <x-slot name="trigger">
                                        <button
                                            class="inline-flex justify-center w-full p-2 rounded bg-zinc-100 hover:opacity-75 dark:bg-zinc-800 dark:lg:bg-transparent lg:bg-transparent"
                                            type="button">
                                            <x-Icons.ellipsis-horizontal />
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link href="{{ route('admin-example.edit', $example->id) }}">
                                            {{ __('編輯') }}
                                        </x-dropdown-link>
                                    </x-slot>
                                </x-dropdown-bottom>
                            </section>
                        </div>
                    </div>
                @empty
                    <div class="p-4 text-sm font-bold text-center bg-white rounded dark:bg-black">
                        @if ($search)
                            找不到搜尋的結果😣
                        @else
                            目前還沒有上架資料😶
                        @endif
                    </div>
                @endforelse

            </div>
            <section>{{ $examples->links('pagination.admin') }}</section>
        </div>
    </section>


    <!-- 5.Dialog -->
    <section>
        <!-- 新增或編輯 (如果要使用對話框來編輯資料可以用) -->
        <x-dialog-modal wire:model.live="showEdit">
            <x-slot name="title">
                {{ __($editTitle) }}
            </x-slot>

            <x-slot name="content">
                <div class="space-y-6">
                    <div>
                        <x-label for="categoryTitle" value="{{ __('分類') }}" />
                        <x-input id="categoryTitle" class="w-full" wire:model="categoryTitle"
                            wire:keydown.enter='saveEdit' placeholder="輸入分類名稱" />
                        <x-input-error for="categoryTitle" class="mt-2" />
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-button wire:click="saveEdit" wire:loading.attr="disabled">
                    {{ __('保存') }}
                </x-button>
            </x-slot>
        </x-dialog-modal>


        <!-- 排序 -->
        <x-dialog-modal wire:model.live="showOrderNumEdit">
            <x-slot name="title">
                {{ __('排序') }}
            </x-slot>

            <x-slot name="content">
                <div class="space-y-6">
                    <div>
                        <x-label for="orderNum" value="{{ __('編輯排序') }}" />
                        <x-input-number id="orderNum" class="w-full" wire:model="orderNum"
                            wire:keydown.enter='updateOrderNum' />
                        <x-input-error for="orderNum" class="mt-2" />
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="updateOrderNum" wire:loading.attr="disabled">
                    {{ __('更新') }}
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>


        <!-- 條件篩選 -->
        <x-dialog-modal wire:model.live="showFilter">
            <x-slot name="title">
                {{ __('條件篩選') }}
            </x-slot>

            <x-slot name="content">
                <div class="space-y-6">
                    <div>
                        <x-input-search clear="{{ $search ? true : false }}" reset="$wire.goRest('search')"
                            placeholder="搜尋關鍵字..." wire:model="search" wire:keydown.enter='goSearch()'
                            wire:click='goSearch()' name="search" />
                    </div>
                    <div>
                        <x-label for="startDate" value="{{ __('開始日期') }}" />
                        <x-input-date id="startDate" class="w-full" wire:model="startDate" />
                    </div>
                    <div>
                        <x-label for="endDate" value="{{ __('結束日期') }}" />
                        <x-input-date id="endDate" class="w-full" wire:model="endDate" />
                    </div>
                    <div>
                        <!-- 啟用狀態 -->
                        <x-label for="endDate" value="{{ __('啟用狀態') }}" />
                        <x-select id="statusActive" wire:model="statusActive" class="w-full text-sm">
                            <option value="">全部狀態</option>
                            <option value="1">啟用</option>
                            <option value="0">關閉</option>
                        </x-select>
                    </div>
                    <div class="text-red-400">{{ $filterMessage }}</div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button x-on:click="$wire.showFilter = false"
                    wire:click="goRest('startDate','endDate','search','statusActive')" wire:loading.attr="disabled">
                    {{ __('重置所有條件') }}
                </x-secondary-button>

                <x-button class="ml-3" wire:click="filter()" wire:loading.attr="disabled">
                    {{ __('篩選') }}
                </x-button>
            </x-slot>
        </x-dialog-modal>


        <!-- 批量操作 -->
        <x-dialog-modal wire:model.live="showBulkAll">
            <x-slot name="title">
                {{ __('批量操作') }}
                <div class="text-sm">
                    <p>目前選取項目:<span class="px-2 text-xl">{{ count($this->selected) }}</span></p>
                    <span class="text-xs text-red-500">若要操作批量刪除請務必確認清楚。</span>
                </div>
            </x-slot>

            <x-slot name="content">
                <section class="flex-wrap space-x-6">
                    <x-button type="button" wire:click="deleteSelected">批量刪除</x-button>
                    <!-- 批量啟用 activeSelected('資料庫欄位')-->
                    <x-button type="button" wire:click="activeSelected('is_active')">批量啟用</x-button>
                    <!-- 批量關閉 -->
                    <x-button type="button" wire:click="closeSelected('is_active')">批量關閉</x-button>
                </section>
            </x-slot>

        </x-dialog-modal>
    </section>
</div>
