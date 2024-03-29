@props(['style' => session('flash.bannerStyle', 'success'), 'message' => session('flash.banner')])
<div x-data="{{ json_encode(['show' => true, 'style' => $style, 'message' => $message]) }}" class="fixed inset-0 z-50" style="display: none;" x-show="show && message"
    x-on:banner-message.window="
                style = event.detail.style;
                message = event.detail.message;
                show = true;
            ">
    <div class="absolute inset-0" x-on:click="show = false"></div>
    <div class="absolute w-full bottom-16" x-on:click="show = false">
        <div class="flex justify-center w-full max-w-xs py-6 mx-auto text-xl text-black rounded bg-amber-400">
            {{ $message }}
        </div>
    </div>
</div>
