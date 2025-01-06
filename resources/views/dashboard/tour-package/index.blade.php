<x-authlayout>
    <div class="container py-4">
        <h1 class="title">Tour Package List</h1>

        <h2 class="text-2xl font-semibold mt-3 py-2">Your Tour Packages ({{ $myTourpackages->total() }})</h2>
        <a href="{{ route('tourpackages.create') }}"
            class="bg-orange-500 hover:bg-orange-600 py-2 px-4 rounded-full text-white inline-block my-2">Add new tour
            package</a>

        {{-- Session Messages --}}
        @if (session('error'))
            <x-flash-msg message="{{ session('error') }}" bg="bg-green-500"></x-flash-msg>
        @endif

        @if (session('success'))
            <x-flash-msg message="{{ session('success') }}" bg="bg-green-500"></x-flash-msg>
        @endif

        <div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                @foreach ($myTourpackages as $tourpackage)
                    <x-tourpackage-card :tourpackage="$tourpackage">
                        <div class="mt-auto flex justify-end gap-1 items-center bg-gray-100 p-2 border-t">
                            {{-- update tourpackage --}}
                            <a href="{{ route('tourpackages.edit', $tourpackage) }}"
                                class="bg-green-500 hover:bg-green-600 py-1 px-3 rounded-full text-white text-sm">Ubah</a>
                            {{-- delete tourpackage --}}
                            <form action="{{ route('tourpackages.destroy', $tourpackage) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" type="submit"
                                    class="bg-red-500 hover:bg-red-600 py-1 px-3 rounded-full text-white text-sm">Hapus</button>
                            </form>
                        </div>
                    </x-tourpackage-card>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $myTourpackages->links() }}
            </div>
        </div>

        <h1 class="text-2xl font-semibold mt-3 py-2">All Tour Packages ({{ $tourpackages->total() }})</h1>

        <div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                @foreach ($tourpackages as $tourpackage)
                    <x-tourpackage-card :tourpackage="$tourpackage"></x-tourpackage-card>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $tourpackages->links() }}
            </div>
        </div>
    </div>
</x-authlayout>
