@props(['tourpackage' => [], 'full' => false])

<div class="relative shadow hover:shadow-lg transition rounded overflow-hidden flex flex-col">
    {{-- cover photo --}}
    <img src="{{ $tourpackage->banner ? asset('storage/' . $tourpackage->banner) : asset('storage/svg/panorama_icon.svg') }}"
        alt="{{ $tourpackage->title ?? 'tourpackage banner' }}"
        class="object-cover object-center w-full h-56 bg-gray-100">

    <x-badge-cat-corner :route="'category-tourpackages'" :cat="$tourpackage->tourpackagecat" />


    <div class="p-6 flex flex-col grow bg-white">
        {{-- title --}}
        <a href="{{ route('tourpackages.show', $tourpackage) }}">
            <h2 class="text-xl lg:text-2xl hover:underline font-semibold capitalize mb-2">{{ $tourpackage->name }}
            </h2>
        </a>
        <div class="w-fit text-xs text-white py-1 px-3 rounded-full bg-blue-500 mb-2">
            {{ $tourpackage->status === 'active' ? 'Tersedia' : 'Tidak Tersedia' }}</div>
        <span class="text-gray-600 mt-2">Mulai dari:</span>
        <p class="text-2xl mb-4 grow font-semibold">Rp{{ number_format($tourpackage->price, 0, ',', '.') }} <span
                class="text-sm text-gray-600">/ Orang</span></p>
        <a href="{{ route('tourpackages.show', $tourpackage) }}" class="btn">Book</a>
    </div>

    {{ $slot }}
</div>
