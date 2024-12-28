<x-authlayout>
    <div class="container">
        <h2 class="text-2xl font-semibold py-2 mt-4">Create New Car Rental</h2>

        {{-- Session Messages --}}
        @if (session('success'))
            <x-flash-msg message="{{ session('success') }}"></x-flash-msg>
        @endif


        <form action="{{ route('sewas.store') }}" method="POST" class="mt-8" enctype="multipart/form-data">
            @csrf

            {{-- Brand Name --}}
            <div class="mb-4">
                <label for="brandName">Brand Name</label>
                <input type="text" name="brandName" id="brandName" value="{{ old('brandName') }}"
                    class="input @error('brandName') !ring-red-500 @enderror">
                @error('brandName')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Car rental category --}}
            <div class="mb-4">
                <label for="carRentalCategory">Category</label>
                <a href="{{ route('blog-categories.index') }}" class="text-sm text-orange-500 hover:underline">tambah
                    category</a>
                <select value="{{ old('carRentalCategory') }}"
                    class="select @error('carRentalCategory') !ring-red-500 @enderror" name="carRentalCategory"
                    id="carRentalCategory">
                    <option value="">-- Select Category</option>
                    @foreach ($carRentalCategories as $crc)
                        <option value="{{ $crc->id }}">{{ $crc->name }}</option>
                    @endforeach
                </select>
                @error('carRentalCategory')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- license_plate --}}
            <div class="mb-4">
                <label for="licensePlate">License Plate</label>
                <select value="{{ old('licensePlate') }}" class="select @error('') !ring-red-500 @enderror"
                    name="licensePlate" id="licensePlate">
                    <option value="">-- Select License Plate</option>
                    <option value="DR">DR</option>
                    <option value="D">D</option>
                </select>
                @error('licensePlate')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- totalPrice --}}
            <div class="mb-4">
                <label for="totalPrice">Total Price</label>
                <input type="text" name="totalPrice" id="totalPrice" value="{{ old('totalPrice') }}"
                    class="input @error('totalPrice') !ring-red-500 @enderror">
                @error('totalPrice')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- color --}}
            <div class="mb-4">
                <label for="color">Color</label>
                <input type="text" name="color" id="color" value="{{ old('color') }}"
                    class="input @error('color') !ring-red-500 @enderror">
                @error('color')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

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
</x-authlayout>
