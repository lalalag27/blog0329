<div class="bg-[#cac9bd]/70  min-h-screen">
    <header>
        ffsdgsd
    </header>
    <main class="border-t border-[#eee] text-[#4f545a]">
        <div class=" w-[80%] mx-auto">
            <div class="pt-7 ">
                news
            </div>
            <div class="pt-24 text-3xl flex justify-center items-center">
                news & topics
            </div>
            <div class="pt-12 grid grid-cols-3 gap-x-5 gap-y-20">
                {{-- {{ dd($news) }} --}}
                @foreach ($news as $new)
                    <a href="{{ route('fe.news.show', ['slug' => $new->slug]) }}" class=" space-y-6">
                        <div class="p-20 bg-[#cac9bd]">
                            <img src="{{ $new->pic }}" alt="{{ $new->title }}"
                                class=" aspect-[330/220] w-full  object-cover">
                        </div>
                        <div class=" space-y-3">
                            <p>
                                {{ $new->updated_at->format('Y.m.d') }}
                            </p>
                            <p>
                                {{ Str::limit($new->body, 50, '...') }}
                            </p>
                        </div>
                    </a>
                @endforeach


            </div>


        </div>

    </main>
    <footer>

    </footer>
</div>
