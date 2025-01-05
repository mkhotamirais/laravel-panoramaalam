@props(['destinationblogs' => []])

<div class="swiper mt-8 mb-4">
    <div class="card-wrapper relative pb-8 pt-0 lg:pt-4">
        <div class="card-list swiper-wrapper">
            @foreach ($destinationblogs as $destinationblog)
                {{-- <div class="card-item swiper-slide h-[30vh]">
                    <img src="{{ $destinationblog->banner ? asset('storage/' . $destinationblog->banner) : asset('storage/svg/panorama_icon.svg') }}"
                        alt="{{ $destinationblog->title }}"
                        class="bg-gray-50 card-image h-full w-full object-cover object-center rounded-xl">
                </div> --}}
                <a href="{{ route('destinationblogs.show', $destinationblog) }}"
                    class="swiper-slide h-[30vh] relative group rounded-xl overflow-hidden">
                    <h1
                        class="z-10 text-2xl capitalize font-semibold absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2 text-center text-white">
                        {{ $destinationblog->title }}</h1>
                    <img src="{{ $destinationblog->banner ? asset('storage/' . $destinationblog->banner) : asset('storage/svg/panorama_icon.svg') }}"
                        alt="{{ $destinationblog->title ?? 'blog banner' }}"
                        class="object-cover object-center w-full h-56 bg-gray-100">
                    <div class="absolute inset-0 bg-black/50 group-hover:bg-black/10 transition"></div>
                </a>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>

        <div class="swiper-slide-button swiper-button-prev">
            {{-- <x-bi-arrow-left-circle /> --}}
        </div>
        <div class="swiper-slide-button swiper-button-next">
            {{-- <x-bi-arrow-right-circle /> --}}
        </div>
    </div>
</div>

<script>
    new Swiper(".card-wrapper", {
        loop: true,
        spaceBetween: 4,

        pagination: {
            el: ".swiper-pagination",
            clickable: true,
            dynamicBullets: true,
        },

        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 4,
            },
        },
    })
</script>
