<div class="bg-[#cac9bd]/70  min-h-screen">
    <header>
        ffsdgsd
    </header>
    <main class="border-t border-[#eee] text-[#4f545a]">
        <div class=" w-[80%] mx-auto">
            <a href="/FeNewsIndex" class="pt-7 text-3xl">
                news
            </a>
            <div class="pt-12">
                <section class="flex justify-center space-x-6">
                    <div class="p-20 bg-[#cac9bd]">
                        <img src="{{ self::getImageUrl($news->pic) }}"
                            alt="" class=" aspect-[330/220] w-full  object-cover">
                    </div>
                    <div class=" space-y-3">
                        <p>
                            {{ $news->updated_at->format('Y.m.d') }}
                        </p>
                        <p>
                            {{ $news->title }}
                        </p>
                        <p>
                            {{ $news->body }}
                        </p>
                    </div>

                </section>
                
            </div>


        </div>

    </main>
    <footer>

    </footer>
</div>
