<x-authlayout>
    <div class="container py-4">
        <h1 class="title">Car Rental List</h1>

        <h2 class="text-2xl font-semibold mt-3 py-2">Car Reentals ({{ $carrentals->total() }})</h2>
        <a href="{{ route('carrentals.create') }}"
            class="bg-orange-500 hover:bg-orange-600 py-2 px-4 rounded-full text-white inline-block my-2">Add new car
            rental</a>

        {{-- Session Messages --}}
        @if (session('delete'))
            <x-flash-msg message="{{ session('delete') }}" bg="bg-green-500"></x-flash-msg>
        @endif

        @if (session('success'))
            <x-flash-msg message="{{ session('success') }}" bg="bg-green-500"></x-flash-msg>
        @endif

        <div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                @foreach ($carrentals as $carrental)
                    <x-carrental-card :carrental="$carrental">
                        <div class="mt-auto flex justify-end gap-1 items-center bg-gray-100 p-2 border-t">
                            {{-- update carrental --}}
                            <a href="{{ route('carrentals.edit', $carrental) }}"
                                class="bg-green-500 hover:bg-green-600 py-1 px-3 rounded-full text-white text-sm">Ubah</a>
                            {{-- delete carrental --}}
                            <form action="{{ route('carrentals.destroy', $carrental) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" type="submit"
                                    class="bg-red-500 hover:bg-red-600 py-1 px-3 rounded-full text-white text-sm">Hapus</button>
                            </form>
                        </div>
                    </x-carrental-card>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $carrentals->links() }}
            </div>
        </div>
    </div>
</x-authlayout>
