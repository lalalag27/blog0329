@props(['title' => '圖片管理', 'imagePath' => null, 'alt' => 'imgManage','xdefault' => true])

<div class="relative w-40 h-40 cursor-pointer group" {{ $attributes }}>
    <div class="absolute inset-0 transition-all rounded opacity-75 bg-zinc-800 group-hover:opacity-20"></div>
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="p-6 text-xl font-bold text-white">
            <p>圖片編輯</p>
        </div>
    </div>

    @if($xdefault == true)
    <img class="object-cover w-40 h-40 border rounded dark:border-zinc-600 group-hover:border-amber-400"
        src="{{ $imagePath }}" alt="{{ $alt }}">
    @else
    {{ $slot }}
    @endif
    
</div>