<x-layout>
    <div class="container py-4">
        <h1 class="title">Car Rental Category List</h1>

        <h2 class="text-2xl mt-4 py-2 font-semibold">Car Rental Category</h2>
        {{-- Session Messages --}}
        @if (session('success'))
            <x-flash-msg message="{{ session('success') }}" bg="bg-green-500"></x-flash-msg>
        @endif
        @if (session('error'))
            <x-flash-msg message="{{ session('delete') }}" bg="bg-green-500"></x-flash-msg>
        @endif

        <div class="mb-4">
            <h3 class="text-xl mt-4 py-2">Add Car Rental Category</h3>
            <form action="{{ route('carrentalcats.store') }}" method="POST" class="">
                @csrf

                <div class="mb-4">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="input @error('name') !ring-red-500 @enderror">
                    @error('name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                    class="bg-orange-500 hover:bg-orange-600 transition py-2 px-6 rounded-full text-white">Create</button>
            </form>
        </div>
        <div class="mb-4">
            <h3 class="text-xl mt-4 py-2">Car Rental List ({{ $carrentalcats->count() }})</h3>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-2">
                @foreach ($carrentalcats as $carrentalcat)
                    <div class="py-2" x-data="{ ubah: false }">
                        <p x-show="!ubah">{{ $carrentalcat->name }}</p>
                        <form x-show="ubah" action="{{ route('carrentalcats.update', $carrentalcat) }}" method="POST"
                            class="w-full">
                            @csrf
                            @method('PUT')
                            <input type="text" name="name" id="name" value="{{ $carrentalcat->name }}"
                                autofocus x-ref="inputUbah" class="w-32" />
                            <button type="submit"
                                class="text-xs bg-green-500 text-white rounded-lg px-2 py-1">simpan</button>
                        </form>
                        <div class="text-xs flex gap-2">
                            <button class="text-green-500"
                                @click="ubah = !ubah; if (ubah) $nextTick(() => $refs.inputUbah.focus())"
                                x-text="ubah ? 'kembali' : 'ubah'"></button> |
                            <form action="{{ route('carrentalcats.destroy', $carrentalcat) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">hapus</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layout>
