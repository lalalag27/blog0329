<div x-data="{
    items: @entangle($attributes->wire('model')),
    selectedOption: $persist('').using(sessionStorage),
    open: false
}">
    <div class="text-xs">
        <button class="p-2 tracking-widest border rounded dark:border-zinc-600 hover:bg-amber-400 dark:hover:text-black"
            x-on:click="open = !open" x-text="selectedOption !== '' ? selectedOption : '請選擇排序方式'">
        </button>

        <div x-show="open" class="fixed inset-0 backdrop-blur">
            <div class="fixed inset-0 bg-zinc-800 opacity-60" x-on:click="open = false">
            </div>
            <div class="absolute bottom-0 flex items-center w-full ">
                <div class="w-full py-10 bg-white dark:bg-black">
                    <div class="w-full max-w-screen-xl mx-auto">
                        <template x-for="item in items">
                            <button type="button"
                                x-on:click="
                                $wire.$set('orderBy.order',item.order),
                                $wire.$set('orderBy.sortField',item.sortField),
                                selectedOption = item.name,
                                open = false",
                                class="w-full p-6 my-2 text-xl hover:bg-amber-400 dark:hover:text-black text-start">
                                <div x-text="item.name" x-init="$watch('items', value => {
                                    if (selectedOption == item.name) {
                                        $wire.$set('orderBy.order', item.order);
                                        $wire.$set('orderBy.sortField', item.sortField);
                                    }
                                })"></div>
                            </button>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
