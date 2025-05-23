<x-layout>
    <div class="container">
        <h2 class="text-2xl font-semibold py-2 mt-4">Create New Car Rental</h2>

        {{-- Session Messages --}}
        @if (session('success'))
            <x-flash-msg message="{{ session('success') }}"></x-flash-msg>
        @endif

        <form action="{{ route('rental-mobil.store') }}" method="POST" class="mt-8" enctype="multipart/form-data">
            @csrf

            {{-- Brand Name --}}
            <div class="mb-4">
                <label for="brand_name">Brand Name</label>
                <input type="text" name="brand_name" id="brand_name" value="{{ old('brand_name') }}"
                    class="input @error('brand_name') !ring-red-500 @enderror">
                @error('brand_name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Car rental category --}}
            <div class="mb-4">
                <label for="carrentalcat_id">Category</label>
                <a href="{{ route('carrentalcats.index') }}" class="text-sm text-orange-500 hover:underline">tambah
                    category</a>
                <select value="{{ old('carrentalcat_id') }}"
                    class="select @error('carrentalcat_id') !ring-red-500 @enderror" name="carrentalcat_id"
                    id="carrentalcat_id">
                    <option value="1">-- Select Category</option>
                    @foreach ($carrentalCategories as $crc)
                        <option value="{{ $crc->id }}">{{ $crc->name }}</option>
                    @endforeach
                </select>
                @error('carrentalcat_id')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- carrental price --}}
            <div class="mb-4">
                <label for="rental_price">Rental Price</label>
                <input type="text" name="rental_price" id="rental_price" value="{{ old('rental_price') }}"
                    class="input @error('rental_price') !ring-red-500 @enderror">
                @error('rental_price')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- policy --}}
            <div class="mb-4">
                <label for="policy">Policy</label>
                <textarea name="policy" id="policy" cols="30" rows="5"
                    class="input @error('policy') !ring-red-500 @enderror">{{ old('policy') }}</textarea>
                @error('policy')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- information --}}
            <div class="mb-4">
                <label for="information">Information</label>
                <textarea name="information" id="information" cols="30" rows="5"
                    class="input @error('information') !ring-red-500 @enderror">{{ old('information') }}</textarea>
                @error('information')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <script>
                ClassicEditor
                    .create(document.querySelector('#policy'))
                    .catch(error => {
                        console.error(error);
                    });
                ClassicEditor
                    .create(document.querySelector('#information'))
                    .catch(error => {
                        console.error(error);
                    });
            </script>

            {{-- banner --}}
            <div class="mb-4">
                <label for="banner">Banner</label>
                <input type="file" name="banner" id="banner"
                    class="input @error('banner') !ring-red-500 @enderror">
                @error('banner')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- submit --}}
            <button type="submit"
                class="bg-orange-500 hover:bg-orange-600 transition py-2 px-6 rounded-full text-white">Create</button>
        </form>
    </div>
</x-layout>
