@props(['carrental' => [], 'full' => false])

<div class="relative shadow hover:shadow-lg transition rounded-lg overflow-hidden flex flex-col">
    {{-- cover photo --}}
    <img src="{{ $carrental->banner ? asset('storage/' . $carrental->banner) : asset('storage/svg/panorama_icon.svg') }}"
        loading="lazy" alt="{{ $carrental->title ?? 'carrental banner' }}"
        class="object-contain object-center w-full bg-gray-100">

    {{-- <x-badge-cat-corner :route="'category-carrentals'" :cat="$carrental->carrentalcat" /> --}}

    <div class="p-4 flex flex-col grow bg-white">
        <div class="grow mb-2">
            <a href="{{ route('rental-mobil.show', $carrental) }}" class="card-title">
                {{ Str::words($carrental->brand_name, 3, '...') }}
            </a>

            <div
                class="border w-fit mb-2 border-blue-500 leading-none px-1 py-[0.15rem] rounded-sm text-blue-900 text-[0.75rem] font-light">
                {{ $carrental->carrentalcat->name }}</div>

            <p class="text-lg grow font-semibold mb-2">
                Rp{{ number_format($carrental->rental_price, 0, ',', '.') }}</p>

        </div>
        <a href="{{ route('rental-mobil.show', $carrental) }}" class="btn">{{ __('common.car-rental.rent-btn') }}</a>
    </div>

    {{ $slot }}
</div>
