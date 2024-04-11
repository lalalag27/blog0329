<div x-data>

    <!-- 網頁標題，展開按鈕等... -->
    <header class="sticky top-0 z-10 w-full bg-amber-400 text-zinc-900">
        <!-- 標題、搜尋Bar、篩選 -->
        <section class="flex items-center justify-between max-w-screen-xl px-6 py-2 mx-auto">
            <!-- 展開選單跟標題 -->
            <livewire:backend.share.header />
        </section>
    </header>

    <!-- 主要編輯區域 -->
    <main class="w-full max-w-screen-xl min-h-screen px-6 mx-auto">
        <section class="py-20">
            <div class="p-10 bg-white rounded shadow lg:p-20 dark:bg-black">
                <!-- 標題 -->
                <h1 class="pb-10">
                    <div class="inline-flex px-6 py-2 text-sm text-black rounded lg:text-2xl bg-amber-400">
                        {{-- {{ $editTitle }} --}}
                    </div>
                </h1>


                <!--編輯或新增表單-->
                <form wire:submit="save" class="space-y-10">

                    <!-- 範本主分類 -->
                    {{-- <div>
                        <x-label for="product_category_id" value="{{ __('產品主分類') }}" />
                        <x-select id="product_category_id" wire:model.live="product_category_id"
                            class="block w-full mt-1">
                            <option value="">請選擇產品分類</option>
                            @foreach ($news as $productCategory)
                                <option value="{{ $productCategory->id }}">
                                    {{ $productCategory->title }}
                                </option>
                            @endforeach
                        </x-select>
                        <x-input-error for="product_category_id" class="mt-2" />
                    </div> --}}


                    <!-- img -->
                    <div>
                        {{-- 判斷image是否有 --}}
                        <label for="pic">Image:</label>
                        <input type="file" wire:model.live="uploadImg" id="pic">

                        @error('uploadImg')
                            <span>{{ $message }}</span>
                        @enderror

                        <div class="max-w-[300px] overflow-hidden rounded-lg">
                            <img src="{{ $uploadImg ? $uploadImg->temporaryUrl() : self::getImageUrl($news->pic) }}"
                                alt="{{ $news->img }}"
                                class=" aspect-[16/9] w-full h-full object-cover group-hover:scale-110 transition-all duration-500">
                        </div>
                    </div>

                    <!-- 範本名稱 -->
                    <div>
                        <x-label for="title" value="{{ __('標題') }}" />
                        <x-input id="title" type="text" class="block w-full mt-1" wire:model="title"
                            autocomplete="title" />
                        <x-input-error for="title" class="mt-2" />
                    </div>

                    <!-- slug名稱 -->
                    <div>
                        <x-label for="slug" value="{{ __('網址名稱') }}" />
                        <x-input id="slug" type="text" class="block w-full mt-1" wire:model="slug"
                            autocomplete="slug" />
                        <x-input-error for="slug" class="mt-2" />
                    </div>


                    <!-- 範本編輯器 -->
                    <div>
                        <x-label for="body" value="{{ __('內文') }}" />
                        <x-tinymce-editor id="body" wire:model="body" />
                        <x-input-error for="body" class="mt-2" />
                    </div>

                    <!-- 保存送出 -->
                    <footer class="flex justify-end space-x-6">
                        <x-button class="bg-zinc-300" type="button" x-on:click="history.back()">取消</x-button>
                        <x-button type="submit">保存</x-button>
                    </footer>

                    <!-- 顯示所有錯誤訊息 -->
                    <x-all-errors />
                </form>
            </div>
        </section>
    </main>
</div>
