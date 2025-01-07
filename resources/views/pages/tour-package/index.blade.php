<x-layout :meta="[
    'title' => __('meta.tour-package.title'),
    'description' => __('meta.tour-package.description'),
    'keywords' => __('meta.tour-package.keywords'),
]">
    <x-section-hero :title="__('menu.tour-package.title')">
        <form class="mt-8">
            {{-- Mempertahankan nilai dari parameter "tourroutes" --}}
            @if (request('tourroutes'))
                @foreach ((array) request('tourroutes') as $tourroute)
                    <input type="hidden" name="tourroutes[]" value="{{ $tourroute }}">
                @endforeach
            @endif

            <div class="items-center mx-auto max-w-screen-sm flex sm:space-y-0">
                <div class="relative w-full">
                    <label for="search"
                        class="hidden mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Search</label>
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <x-bi-search class="w-5 h-5 text-gray-500 dark:text-gray-400"></x-bi-search>
                    </div>
                    <input name="search" autocomplete="off" value="{{ $search }}"
                        class="block p-3 pl-10 w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-l-lg focus:ring-primary-500 focus:border-primary-500"
                        placeholder="Search blogs" type="text" id="search">
                </div>
                <div>
                    <button type="submit"
                        class="rounded-l-none py-3 px-5 text-sm font-medium text-center text-white border cursor-pointer bg-orange-500 transition hover:bg-orange-600  rounded-r-lg focus:ring-4 focus:ring-orange-300">
                        Cari
                    </button>
                </div>
            </div>
        </form>

        <x-badge-cat :cats="$tourpackagecats" :route="'category-tourpackages'" />

        @if (!empty($selectedTourroutes))
            <form id="filterForm" action="{{ route('tour-package') }}" method="GET" class="flex mt-2 items-center">
                {{-- Mempertahankan nilai dari parameter "search" --}}
                @if (request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
                <label class="mr-2 text-sm">Routes :</label>
                <div class="flex gap-1">
                    @foreach ($tourroutes as $tourroute)
                        <input class="hidden" type="checkbox" id="filter_tourroute_{{ $tourroute->slug }}"
                            name="tourroutes[]" value="{{ $tourroute->slug }}"
                            {{ in_array($tourroute->slug, $selectedTourroutes) ? 'checked' : '' }}
                            onchange="document.getElementById('filterForm').submit()">
                        <label for="filter_tourroute_{{ $tourroute->slug }}"
                            class="font-light border backdrop-blur border-gray-700 rounded-lg hover:border-orange-500 text-xs py-[0.10rem] px-2 {{ in_array($tourroute->slug, $selectedTourroutes) ? 'bg-orange-500' : '' }}">{{ $tourroute->name }}</label>
                    @endforeach
                </div>
            </form>
        @endif

    </x-section-hero>
    <div class="container">

    </div>
    {{-- paket wisata list --}}
    <section class="py-16">
        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($tourpackages as $tourpackage)
                    <x-tourpackage-card :tourpackage="$tourpackage"></x-tourpackage-card>
                @endforeach
            </div>
        </div>
    </section>

    <x-section-destination :destinationblogs="$destinationblogs" />

</x-layout>
