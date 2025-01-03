@props(['carrental' => [], 'full' => false])

<div class="relative shadow hover:shadow-lg transition rounded overflow-hidden flex flex-col">
    {{-- cover photo --}}
    <img src="{{ $carrental->banner ? asset('storage/' . $carrental->banner) : asset('storage/svg/panorama_icon.svg') }}"
        alt="{{ $carrental->title ?? 'carrental banner' }}" class="object-contain object-center w-full bg-gray-100">

    <x-badge-cat-corner :route="'category-carrentals'" :cat="$carrental->carrentalcat" />

    <div class="p-6 flex flex-col grow bg-white">
        {{-- title --}}
        <a href="{{ route('carrentals.show', $carrental) }}">
            <h2 class="text-xl lg:text-2xl hover:underline font-medium capitalize mb-2">{{ $carrental->brand_name }}
            </h2>
        </a>
        <p class="text-2xl mb-4 grow font-semibold">Rp{{ number_format($carrental->rental_price, 0, ',', '.') }}</p>
        <a href="{{ route('carrentals.show', $carrental) }}" class="btn">Rent</a>
    </div>

    {{ $slot }}
</div>
