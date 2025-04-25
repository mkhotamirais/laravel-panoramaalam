<x-layout>
    {{-- hero --}}
    <x-section-hero height="h-[80vh] lg:h-[calc(100vh-4rem)]">
        <div class="mt-8 space-y-8">
            <p class="deskripsi max-w-screen-sm">{!! __('common.home.hero.description') !!}</p>
            <div class="flex flex-col lg:flex-row gap-2">
                <a href="{{ route('rental-mobil') }}"
                    class="lg:px-6 lg:py-4 uppercase btn w-44">{{ __('common.common.car-rental-btn') }}</a>
                <a href="{{ route('paket-wisata') }}"
                    class="lg:px-6 lg:py-4 uppercase btn w-44 !bg-transparent border border-orange-500 hover:text-orange-600">{{ __('common.common.tour-package-btn') }}</a>
            </div>
        </div>
    </x-section-hero>

    {{-- carrental --}}
    <section class="py-16 bg-gray-50">
        <div class="container">
            <div>
                <h3 class="up-title">{{ __('common.home.car-rental.title') }}</h3>
                <div class="h-[3px] bg-orange-500 w-16 rounded-full my-2"></div>
                <h1 class="title leading-tight max-w-4xl">{{ __('common.home.car-rental.big-title') }}</h1>
            </div>
            <div class="swiper my-4">
                <div class="card-wrapper relative pb-8 pt-0 lg:pt-4">
                    <div class="card-list swiper-wrapper">
                        @foreach ($carrentals as $carrental)
                            <div class="swiper-slide">
                                <x-carrental-card :carrental="$carrental"></x-carrental-card>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>

                    <div class="swiper-slide-button swiper-button-prev">
                        <x-bi-arrow-left-circle />
                    </div>
                    <div class="swiper-slide-button swiper-button-next">
                        <x-bi-arrow-right-circle />
                    </div>
                </div>
            </div>
            <a href="{{ route('rental-mobil') }}"
                class="py-3 px-6 rounded-full border-2 border-orange-500 text-orange-500 inline-block">{{ __('common.common.view-all') }}</a>
        </div>
    </section>

    {{-- tourpackage --}}
    <section class="py-16">
        <div class="container">
            <div>
                <h3 class="up-title">{{ __('common.home.tour-package.title') }}</h3>
                <div class="h-[3px] bg-orange-500 w-16 rounded-full my-2"></div>
                <h1 class="title leading-tight max-w-4xl">{{ __('common.home.tour-package.big-title') }}</h1>
            </div>
            <div class="swiper my-4">
                <div class="card-wrapper relative pb-8 pt-0 lg:pt-4">
                    <div class="card-list swiper-wrapper">
                        @foreach ($tourpackages as $tourpackage)
                            <div class="swiper-slide">
                                <x-tourpackage-card :tourpackage="$tourpackage"></x-tourpackage-card>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>

                    <div class="swiper-slide-button swiper-button-prev">
                        <x-bi-arrow-left-circle />
                    </div>
                    <div class="swiper-slide-button swiper-button-next">
                        <x-bi-arrow-right-circle />
                    </div>
                </div>
            </div>
            <a href="{{ route('paket-wisata') }}"
                class="py-3 px-6 rounded-full border-2 border-orange-500 text-orange-500 inline-block">{{ __('common.common.view-all') }}</a>

        </div>
    </section>

    {{-- contact --}}
    <x-section-contact bg="bg-gray-50" />

    {{-- blogs --}}
    <x-section-blog :blogs="$blogs" />

    {{-- destination --}}
    <x-section-destination :destinationblogs="$destinationblogs" bg="bg-gray-50" />

    {{-- swiper --}}
    <script>
        new Swiper(".card-wrapper", {
            loop: false,
            spaceBetween: 12,

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
</x-layout>
