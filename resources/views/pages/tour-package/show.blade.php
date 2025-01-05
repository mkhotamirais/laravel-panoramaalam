<x-layout>
    <section class="lg:container">
        {{-- <div class="h-[70vh] rounded-xl overflow-hidden">
                <img src="{{ $tourpackage->banner ? asset('storage/' . $tourpackage->banner) : asset('storage/svg/panorama_icon.svg') }}"
                    alt="{{ $tourpackage->title ?? 'tourpackage banner' }}"
                    class="object-cover object-center w-full h-full bg-gray-100" />
            </div> --}}
        <div class="swiper">
            <div class="card-wrapper relative pb-8 pt-0 lg:pt-4">
                <div class="card-list swiper-wrapper">
                    @foreach ($tourpackage->tourimages as $image)
                        <div class="card-item swiper-slide h-[70vh]">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $tourpackage->title }}"
                                class="card-image h-full w-full object-cover object-center rounded-xl">
                        </div>
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

        <div class="flex flex-col px-4 space-y-4 leading-relaxed mt-8">
            {{-- title --}}
            <div class="flex flex-col space-y-4 lg:space-y-0 lg:flex-row justify-between items-start">
                <div>
                    {{-- <h3 class="w-fit">{{ $tourpackage->tourpackagecat->name ?? 'cat' }}</h3> --}}
                    <h2 class="text-2xl lg:text-3xl font-semibold capitalize mb-2">{{ $tourpackage->name }}</h2>
                    <span class="text-gray-600">Mulai dari:</span>
                    <p class="text-2xl mb-2 font-semibold">
                        Rp{{ number_format($tourpackage->price, 0, ',', '.') }} <span class="text-sm text-gray-600">/
                            Orang</span></p>

                </div>
                <a href="#pesan" class="btn">Book Now</a>
            </div>

            <details class="pb-6">
                <summary class="text-lg text-orange-500 hover:underline cursor-pointer w-fit font-semibold mb-2">Detail
                    Harga
                </summary>
                <div class="text-price">{!! $tourpackage->price_detail !!}</div>
            </details>

            {{-- itenary --}}
            <x-details title="Itenary" bg="bg-green-50" :description="$tourpackage->itenary_description" detail_title="Detail Itenary"
                :detail="$tourpackage->itenary_detail">
                <x-slot:icon><x-bi-geo-alt class="w-6 h-6" /></x-slot:icon>
            </x-details>

            {{-- policy --}}
            <x-details title="Policy" :description="$tourpackage->policy_description" detail_title="Detail Policy" :detail="$tourpackage->policy_detail">
                <x-slot:icon><x-bi-shield-check class="w-6 h-6" /></x-slot:icon>
            </x-details>

            {{-- info --}}
            <x-details title="Info" bg="bg-green-50" :description="$tourpackage->info_description" detail_title="Detail Info" :detail="$tourpackage->info_detail">
                <x-slot:icon><x-bi-info-circle class="w-6 h-6" /></x-slot:icon>
            </x-details>

            <div id="pesan" class="scroll-mt-20">
                <x-section-order />
            </div>
        </div>
    </section>

    <div class="container">
        <div class="flex justify-between items-center py-2 mt-4 mb-2">
            <h2 class="text-2xl font-semibold">Tourpackage lainnya</h2>
            <a href="{{ route('tourpackages.index') }}"
                class="text-orange-500 min-w-max hover:underline flex gap-2 items-center">
                <span>Lihat Semua</span>
                <x-bi-arrow-right class="w-4 flex" />
            </a>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-8">
            @foreach ($latestThreeTourpackages as $tourpackage)
                <x-tourpackage-card :tourpackage="$tourpackage"></x-tourpackage-card>
            @endforeach
        </div>
    </div>

    <!-- swiper -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script> --}}
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
                    slidesPerView: 3,
                },
            },
        })
    </script>


</x-layout>
