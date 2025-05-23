<x-layout :title="__('common.meta.car-rental.title')" :description="__('common.meta.car-rental.description')">
    <x-section-hero :title="__('common.car-rental.title')" :total="$carrentals->total()">
        <form class="mt-8 max-w-screen-sm">

            {{-- @if (request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif --}}

            @if (request('sort'))
                <input type="hidden" name="sort" value="{{ request('sort') }}">
            @endif

            @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif

            <div class="items-center mx-auto max-w-screen-sm flex sm:space-y-0">
                <div class="relative w-full">
                    <label for="search"
                        class="hidden mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('common.common.search-btn') }}</label>
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <x-bi-search class="w-5 h-5 text-gray-500 dark:text-gray-400"></x-bi-search>
                    </div>
                    <input type="search" name="search" autocomplete="off" value="{{ $search }}"
                        class="block p-3 pl-10 w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-l-lg focus:ring-primary-500 focus:border-primary-500"
                        placeholder="{{ __('common.common.search-placeholder') }}" type="text" id="search">
                </div>
                <div>
                    <button type="submit"
                        class="rounded-l-none py-3 px-5 text-sm font-medium text-center text-white border cursor-pointer bg-orange-500 transition hover:bg-orange-600  rounded-r-lg focus:ring-4 focus:ring-orange-300">
                        {{ __('common.common.search-btn') }}
                    </button>
                </div>
            </div>
        </form>

    </x-section-hero>

    @auth
        <div class="container mt-8">
            <a href="{{ route('rental-mobil.create') }}"
                class="bg-orange-500 hover:bg-orange-600 py-2 px-4 rounded-full text-white inline-block my-2">Add new car
                rental</a>

            {{-- Session Messages --}}
            @if (session('delete'))
                <x-flash-msg message="{{ session('delete') }}" bg="bg-green-500"></x-flash-msg>
            @endif

            @if (session('success'))
                <x-flash-msg message="{{ session('success') }}" bg="bg-green-500"></x-flash-msg>
            @endif
        </div>
    @endauth

    <div class="container mt-8">
        <div class="flex flex-col gap-2 lg:flex-row lg:items-center justify-between">
            <div class="relative">
                <x-badge-cat :cats="$carrentalcats" />
            </div>
            <x-badge-sorting :sorting="__('common.common.sorting-price')" />
        </div>
    </div>

    @if ($search)
        <div class="container py-6">
            <p class="text-xl">
                {{ __('common.car-rental.results.start') }} <span
                    class="text-orange-500 font-semibold italic">"{{ $search }}"</span>
                {{ __('common.car-rental.results.end') }} ( {{ $carrentals->total() }} )
            </p>
        </div>
    @endif

    {{-- sewa mobil list --}}
    @if ($carrentals->total() == 0)
        <div class="container">
            <p class="text-3xl italic font-semibold mt-4">{{ __('common.car-rental.results.not-found') }}</p>
        </div>
    @else
        <section class="container py-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 lg:gap-4">
                @foreach ($carrentals as $carrental)
                    <x-carrental-card :carrental="$carrental">
                        @auth
                            <div class="mt-auto flex justify-end gap-1 items-center bg-gray-100 p-2 border-t">
                                {{-- update carrental --}}
                                <a href="{{ route('rental-mobil.edit', $carrental) }}"
                                    class="bg-green-500 hover:bg-green-600 py-1 px-3 rounded-full text-white text-sm">Ubah</a>
                                {{-- delete carrental --}}
                                <form action="{{ route('rental-mobil.destroy', $carrental) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')" type="submit"
                                        class="bg-red-500 hover:bg-red-600 py-1 px-3 rounded-full text-white text-sm">Hapus</button>
                                </form>
                            </div>
                        @endauth
                    </x-carrental-card>
                @endforeach
            </div>
            <div class="mt-8">
                {{ $carrentals->links() }}
            </div>
        </section>
    @endif

    <x-section-destination :destinationblogs="$destinationblogs" />

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
