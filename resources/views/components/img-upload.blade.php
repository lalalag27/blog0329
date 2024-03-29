@props([
    'tmpPhotos' => null, // 傳wire:model的變量像這樣 :tmpPhotos="$tmpPhotos" 使用
    'field' => 'tmpPhotos', // wire:model綁定圖片變量字串 用來顯示錯誤訊息
    'alt' => 'tmpPhotoAlt', // wire:model綁定圖片說明變量字串 用來顯示錯誤訊息
    'order' => 'tmpPhotoOrderNum', // wire:model綁定圖片排序變量字串 用來顯示錯誤訊息
    'useMultiple' => false, // 是否多張上傳
])

<div x-data>
    <div class="pb-6">
        <!--圖片上傳-->
        <div class="py-6">
            <label for="imgUpload">
                <input type="file" {{ $attributes }} id="imgUpload" accept="image/*" x-show="false" />
                <div class="inline-flex items-center space-x-2 ">
                    <div
                        class="inline-flex px-10 py-2 text-sm transition-all border rounded cursor-pointer border-amber-400 hover:bg-amber-400 hover:text-black">
                        <p>點擊上傳圖片</p>
                        <div wire:loading wire:target="{{ $field }}">Uploading...</div>
                    </div>
                    @error($field)
                        <div class="text-xs text-red-500">{{ $message }}</div>
                    @enderror
                </div>
            </label>
        </div>

        <!--顯示暫存圖片-->
        @if ($tmpPhotos)
            <div
                class="{{ $useMultiple ? 'grid grid-cols-1 gap-6 lg:grid-cols-3 md:grid-cols-2' : 'grid grid-cols-1 space-y-6' }}">
                @foreach ($tmpPhotos as $index => $tmpPhoto)
                    <div wire:key="image-{{ $index }}"
                        class="p-6 space-y-4 border rounded dark:border-zinc-600 bg-zinc-100 dark:bg-zinc-900">
                        <div class="flex items-center space-x-4">
                            <img src="{{ $tmpPhoto->temporaryUrl() }}"
                                class="object-cover w-20 h-20 border rounded dark:border-zinc-600">
                            <x-secondary-button
                                wire:click="removeTmpPhoto({{ $index }})">取消上傳</x-secondary-button>
                        </div>
                        <div>
                            <x-label class="text-xs" for="{{ $alt }}.{{ $index }}"
                                value="{{ __('圖片說明') }}" />
                            <x-input class="w-full" placeholder="請填寫圖片說明建議不要超過15字元"
                                id="{{ $alt }}.{{ $index }}"
                                wire:model="{{ $alt }}.{{ $index }}" />
                            <x-input-error for="{{ $alt }}.{{ $index }}" class="mt-2" />
                        </div>
                        <div>
                            <x-label class="text-xs" for="{{ $order }}.{{ $index }}"
                                value="{{ __('圖片排序') }}" />
                            <x-input-number class="w-full" id="{{ $order }}.{{ $index }}"
                                wire:model="{{ $order }}.{{ $index }}" placeholder="請填寫數字" />
                            <x-input-error for="{{ $order }}.{{ $index }}" class="mt-2" />
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
