@props(['tourpackage' => [], 'full' => false])

<div class="relative hover:shadow-lg transition border rounded-lg overflow-hidden flex flex-col">
    {{-- cover photo --}}
    <img src="{{ $tourpackage->banner ? asset('storage/' . $tourpackage->banner) : asset('storage/svg/panorama_icon.svg') }}"
        alt="{{ $tourpackage->title ?? 'tourpackage banner' }}" class="object-contain object-center w-full bg-gray-100">

    {{-- <x-badge-cat-corner :route="'category-tourpackages'" :cat="$tourpackage->tourpackagecat" /> --}}

    <div class="p-4 flex flex-col grow bg-white">
        <div class="grow mb-2">

            <a href="{{ route('tourpackages.show', $tourpackage) }}" class="card-title">
                {{ Str::words($tourpackage->name, 6, '...') }}
            </a>

            <div class="flex gap-1 m1-1 mb-4 flex-wrap">
                <div
                    class="border w-fit border-blue-500 leading-none px-1 py-[0.15rem] rounded-sm text-blue-500 text-[0.75rem] font-light">
                    {{ $tourpackage->status === 'active' ? 'Tersedia' : 'Tidak Tersedia' }}</div>
                <div
                    class="overflow-x-scroll min-w-max border w-fit border-blue-500 leading-none px-1 py-[0.15rem] rounded-sm text-blue-900 text-[0.75rem] font-light">
                    {{ $tourpackage->tourpackagecat->name }}</div>
            </div>

            <div class="text-gray-600 text-sm">{{ __('menu.tour-package.price.start') }}</div>
            <p class="text-lg mb-4 grow font-semibold">Rp{{ number_format($tourpackage->price, 0, ',', '.') }}
                <span class="text-sm text-gray-600 font-medium">/ {{ __('menu.tour-package.price.end') }}</span>
            </p>

            {{-- <div class="mb-4">
            <span class="text-gray-600 min-w-fit font-semibold">Route :</span>
            @if ($tourpackage->tourroutes->isEmpty())
                <span>-</span>
            @else
                <span class="">
                    @foreach ($tourpackage->tourroutes as $index => $tourroute)
                        <span class="min-w-fit text-sm capitalize">
                            {{ $tourroute->name }}{{ $index < $tourpackage->tourroutes->count() - 1 ? ' -' : '' }}
                        </span>
                    @endforeach
                </span>
            @endif
        </div> --}}
        </div>

        <a href="{{ route('tourpackages.show', $tourpackage) }}"
            class="btn">{{ __('menu.tour-package.book-btn') }}</a>
    </div>
    {{ $slot }}
</div>
