<x-layout>
    <x-section-hero :height="'h-[75vh]'">
        <h3 class="font-semibold text-2xl text-orange-400">Tour and Travel</h3>
        <div class="mt-8 space-y-8">
            <p class="deskripsi max-w-screen-sm">{!! __('menu.home.hero.description') !!}</p>
            <a href="#produk"
                class="lg:px-6 lg:py-4 uppercase btn w-fit"><span>{{ __('menu.home.hero.hero-btn') }}</span></a>
        </div>
    </x-section-hero>

    {{-- produk dan layanan --}}
    <section id="produk" class="pt-12 pb-16 scroll-mt-16">
        <div class="container max-w-screen-lg">
            <div class="text-center">
                <h3 class="up-title">{{ __('menu.home.products.title') }}</h3>
                <div class="h-[3px] bg-orange-500 w-16 mx-auto rounded-full my-2"></div>
                <h1 class="title">{{ __('menu.home.products.big-title') }}</h1>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mt-8">
                @foreach (__('menu.home.products.offers') as $offers)
                    <div
                        class="p-8 leading-relaxed border-b overflow-hidden shadow-md hover:shadow-xl transition rounded-lg">
                        <img src="{{ asset($offers['image']) }}" alt="" class="scale-90">
                        <h2 class="text-2xl md:text-3xl font-semibold mb-4">{{ $offers['title'] }}</h2>
                        <p class="mb-8 text-gray-600">{{ $offers['description'] }}</p>
                        <a href="{{ $offers['href'] }}"
                            class="font-semibold rounded-full px-5 py-3 bg-orange-500 hover:bg-orange-600 transition text-white">{{ __('menu.home.products.detail-btn') }}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- tentang kami (tidak dipakai) --}}
    {{-- <section class="py-16 bg-gray-50">
        <div class="container">
            <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-16">
                <div>
                    <h3 class="up-title">Tentang Kami</h3>
                    <div class="h-[3px] bg-orange-500 w-16 rounded-full my-2"></div>
                    <h1 class="title !leading-relaxed">Lebih dekat dengan Panoramaalam</h1>
                    <p class="leading-loose mt-8">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Deserunt amet soluta vitae, inventore
                        exercitationem, rem provident, iure mollitia officiis dignissimos ipsam consectetur. Adipisci
                        necessitatibus nemo eum excepturi placeat quis distinctio esse id, doloremque dolorem pariatur
                        minus, delectus corrupti eveniet maxime.
                    </p>
                    <a href=""
                        class="font-semibold text-orange-500 hover:text-orange-600 transition hover:underline mt-12 flex w-fit items-center gap-2">
                        <div>Lebih Lanjut</div>
                        <x-bi-arrow-right class="w-4 flex" />
                    </a>
                </div>
                <div>
                    <img src="https://picsum.photos/500" alt=""
                        class="object-cover object-center w-full h-full">
                </div>
            </div>
        </div>
    </section> --}}

    {{-- blog --}}
    <section class="py-16 bg-gray-50">
        <div class="container">
            <div>
                <h3 class="up-title">{{ __('menu.home.blogs.title') }}</h3>
                <div class="h-[3px] bg-orange-500 w-16 rounded-full my-2"></div>
                <h1 class="title leading-tight">{{ __('menu.home.blogs.big-title') }}</h1>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mt-8">
                @foreach ($latestThreeBlogs as $blog)
                    <x-blog-card :blog="$blog"></x-blog-card>
                @endforeach
            </div>
            <div class="flex items-center mt-8">
                <a href="{{ route('blog') }}" class="btn">{{ __('menu.home.blogs.all-blog-btn') }}</a>
            </div>
        </div>
    </section>

    {{-- contact (tidak dipakai) --}}
    {{-- <section class="bg-[url('https://picsum.photos/1440/720')] bg-conver bg-center min-h-[30vh] bg-fixed">
        <div class="bg-gradient-to-t from-black/50 to-black/70 min-h-[30vh] flex flex-col items-center justify-center">
            <div class="container text-white py-12">
                <div class="flex flex-col gap-4 items-center justify-center text-center">
                    <h1 class="title">Mau sewa mobil atau pilih paket liburan?</h1>
                    <p class="text-lg">Hubungi kami untuk reservasi dan info lebih lengkap.</p>
                    <a href=""
                        class="group border-2 border-orange-200 rounded-xl p-4 flex items-center gap-4 text-2xl hover:ring-2 hover:ring-orange-500 transition">
                        <img src="https://raw.githubusercontent.com/grommet/grommet-icons/master/public/img/whatsapp.svg"
                            alt="" class="size-12">
                        <div class="text-white group-hover:text-orange-500 transition">Hubungi Kami</div>
                    </a>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- contact --}}
    <x-section-contact />

    {{-- galery --}}
    {{-- <section class="py-16">
        <div class="container">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <img src="https://picsum.photos/500" alt="" class="object-cover object-center w-full">
                <img src="https://picsum.photos/500" alt="" class="object-cover object-center w-full">
                <img src="https://picsum.photos/500" alt="" class="object-cover object-center w-full">
            </div>
        </div>
    </section> --}}
</x-layout>
