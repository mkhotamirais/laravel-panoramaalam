@props(['carrental' => [], 'full' => false])

<div class="relative shadow hover:shadow-lg transition rounded overflow-hidden flex flex-col">
    {{-- cover photo --}}
    <img src="{{ $carrental->banner ? asset('storage/' . $carrental->banner) : asset('storage/svg/panorama_icon.svg') }}"
        alt="{{ $carrental->title ?? 'carrental banner' }}" class="object-cover object-center w-full h-56 bg-gray-100">

    <div class="p-6 flex flex-col grow bg-white">
        {{-- title --}}
        <a href="{{ route('carrentals.show', $carrental) }}">
            <h2 class="text-xl lg:text-2xl hover:underline font-semibold capitalize mb-2">{{ $carrental->brand_name }}
            </h2>
        </a>
        <a href="{{ route('carrentals.show', $carrental) }}"
            class="absolute top-4 right-4 w-fit text-xs bg-green-500/80 hover:bg-green-600 py-1 px-3 rounded-full text-white">{{ $carrental->carrentalcat->name ?? 'cat' }}</a>
        <p class="text-gray-600 text-4xl mb-4 grow">Rp{{ number_format($carrental->rental_price, 0, ',', '.') }}</p>
        {{-- <p>info</p>
        <p>description</p> --}}
        <a href="{{ route('carrentals.show', $carrental) }}" class="btn">Rent</a>
    </div>

    {{ $slot }}
</div>
