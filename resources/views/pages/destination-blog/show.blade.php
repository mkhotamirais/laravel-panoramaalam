<x-layout>
    <div class="pb-16 pt-0 lg:pt-16">
        <div class="max-w-screen-lg mx-auto">
            <div class="flex flex-col">
                <div class="mb-8 text-center hidden lg:block">
                    {{-- title --}}
                    <h2 class="text-5xl font-semibold capitalize">{{ $destinationblog->title }}</h2>
                    {{-- author and date --}}
                    <div class="text-gray-500 mt-2">
                        <span>Posted {{ $destinationblog->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                {{-- cover photo --}}
                <img src="{{ $destinationblog->banner ? asset('storage/' . $destinationblog->banner) : asset('storage/svg/panorama_icon.svg') }}"
                    alt="{{ $destinationblog->title ?? 'destinationblog banner' }}"
                    class="object-cover object-center aspect-[16/9] rounded-none lg:rounded-lg bg-gray-100">

                <div class="flex flex-col px-4 lg:px-0 mt-4 max-w-screen-sm mr-auto">
                    <div class="block lg:hidden">
                        {{-- title --}}
                        <h2 class="text-3xl font-semibold capitalize">{{ $destinationblog->title }}</h2>
                        {{-- author and date --}}
                        <div class="text-sm text-gray-600">
                            <span>Posted {{ $destinationblog->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    {{-- content --}}
                    <div class="text-content">{!! $destinationblog->content !!}</div>
                </div>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="flex justify-between items-center py-2 mt-4 mb-2">
            <h2 class="text-2xl font-semibold">Destinationblog lainnya</h2>
            <a href="{{ route('destination-blog') }}"
                class="text-orange-500 min-w-max hover:underline flex gap-2 items-center">
                <span>Lihat Semua</span>
                <x-bi-arrow-right class="w-4 flex" />
            </a>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-8">
            @foreach ($latestThreeDestinationblogs as $destinationblog)
                <x-blog-card :blog="$destinationblog" route="destinationblogs.show" :fullblog="false"></x-blog-card>
            @endforeach
        </div>
    </div>
</x-layout>
