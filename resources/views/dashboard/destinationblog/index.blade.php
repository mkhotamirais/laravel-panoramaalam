<x-authlayout>
    <div class="container py-4">
        <h1 class="title">Destinationblog List</h1>

        <h1 class="text-2xl font-semibold mt-3 py-2">All Destinationblog ({{ $destinationblogs->total() }})</h1>
        <a href="{{ route('destinationblogs.create') }}"
            class="bg-orange-500 hover:bg-orange-600 py-2 px-4 rounded-full text-white inline-block my-2">Add New
            Destinationblog</a>

        @if (session('success'))
            <x-flash-msg message="{{ session('success') }}" bg="bg-green-500"></x-flash-msg>
        @endif

        <div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                @foreach ($destinationblogs as $destinationblog)
                    <a href="{{ route('destinationblogs.show', $destinationblog) }}"
                        class="relative group rounded-xl overflow-hidden">
                        <h1
                            class="z-10 text-2xl capitalize font-semibold absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2 text-center text-white">
                            {{ $destinationblog->title }}</h1>
                        <img src="{{ $destinationblog->banner ? asset('storage/' . $destinationblog->banner) : asset('storage/svg/panorama_icon.svg') }}"
                            alt="{{ $destinationblog->title ?? 'blog banner' }}"
                            class="object-cover object-center w-full h-56 bg-gray-100">
                        <div class="absolute inset-0 bg-black/50 group-hover:bg-black/10 transition"></div>
                    </a>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $destinationblogs->links() }}
            </div>
        </div>

        <x-blog-destination :destinationblogs="$destinationblogs"></x-blog-destination>

    </div>
</x-authlayout>
