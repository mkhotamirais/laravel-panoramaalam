<x-layout :title="__('menu.tour-package.title')">
    {{-- untuk single tour package (nanti dipindah) --}}

    {{-- <section>
        <div>carousel</div>
        <div>
            <h3>topjudul</h3>
            <h2>big judul</h2>
        </div>
        <div>
            <p>harga</p>
            <button>tombol pesan</button>
        </div>
    </section> --}}
    <x-section-hero :title="__('menu.tour-package.title')">
        {{-- <div class="h-1 bg-orange-500 w-32"></div> --}}
        {{-- search form --}}
        <form class="mt-8">
            {{-- @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif

            @if (request('author'))
                <input type="hidden" name="author" value="{{ request('author') }}">
            @endif --}}

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
    </x-section-hero>
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
</x-layout>
