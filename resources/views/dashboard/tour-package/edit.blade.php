<x-authlayout>
    <div class="container">
        <h2 class="text-2xl font-semibold py-2 mt-4">Update Tour Package</h2>

        {{-- Session Messages --}}
        @if (session('success'))
            <x-flash-msg message="{{ session('success') }}"></x-flash-msg>
        @endif

        <form action="{{ route('tourpackages.update', $tourpackage) }}" method="POST" class="mt-8"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div class="mb-4">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ $tourpackage->name }}"
                    class="input @error('name') !ring-red-500 @enderror">
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- detail --}}
            <div class="mb-4">
                <label for="detail">Detail</label>
                <textarea name="detail" id="detail" cols="30" rows="5"
                    class="input @error('detail') !ring-red-500 @enderror">{{ $tourpackage->detail }}</textarea>
                @error('detail')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- tourpackage price --}}
            <div class="mb-4">
                <label for="price">Price</label>
                <input type="text" name="price" id="price" value="{{ $tourpackage->price }}"
                    class="input @error('price') !ring-red-500 @enderror">
                @error('price')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- price_detail --}}
            <div class="mb-4">
                <label for="price_detail">Price Detail</label>
                <textarea name="price_detail" id="price_detail" cols="30" rows="5"
                    class="input @error('price_detail') !ring-red-500 @enderror">{{ $tourpackage->price_detail }}</textarea>
                @error('price_detail')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Itenary Description --}}
            <div class="mb-4">
                <label for="itenary_description">Itenary Description</label>
                <input type="text" name="itenary_description" id="itenary_description"
                    value="{{ $tourpackage->itenary_description }}"
                    class="input @error('itenary_description') !ring-red-500 @enderror">
                @error('itenary_description')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- itenary_detail --}}
            <div class="mb-4">
                <label for="itenary_detail">Itenary Detail</label>
                <textarea name="itenary_detail" id="itenary_detail" cols="30" rows="5"
                    class="input @error('itenary_detail') !ring-red-500 @enderror">{{ $tourpackage->itenary_detail }}</textarea>
                @error('itenary_detail')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Policy Description --}}
            <div class="mb-4">
                <label for="policy_description">Policy Description</label>
                <input type="text" name="policy_description" id="policy_description"
                    value="{{ $tourpackage->policy_description }}"
                    class="input @error('policy_description') !ring-red-500 @enderror">
                @error('policy_description')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- policy_detail --}}
            <div class="mb-4">
                <label for="policy_detail">Policy Detail</label>
                <textarea name="policy_detail" id="policy_detail" cols="30" rows="5"
                    class="input @error('policy_detail') !ring-red-500 @enderror">{{ $tourpackage->policy_detail }}</textarea>
                @error('policy_detail')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>


            {{-- Info Description --}}
            <div class="mb-4">
                <label for="info_description">Info Description</label>
                <input type="text" name="info_description" id="info_description"
                    value="{{ $tourpackage->info_description }}"
                    class="input @error('info_description') !ring-red-500 @enderror">
                @error('info_description')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- info_detail --}}
            <div class="mb-4">
                <label for="info_detail">Info Detail</label>
                <textarea name="info_detail" id="info_detail" cols="30" rows="5"
                    class="input @error('info_detail') !ring-red-500 @enderror">{{ $tourpackage->info_detail }}</textarea>
                @error('info_detail')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tour Package category --}}
            <div class="mb-4">
                <label for="tourpackagecat_id">Category</label>
                <a href="{{ route('tourpackagecats.index') }}" class="text-sm text-orange-500 hover:underline">tambah
                    category</a>
                <select class="select @error('tourpackagecat_id') !ring-red-500 @enderror" name="tourpackagecat_id"
                    id="tourpackagecat_id">
                    <option value="1">-- Select Category</option>
                    @foreach ($tourpackagecats as $tourpackagecat)
                        <option value="{{ $tourpackagecat->id }}"
                            {{ $tourpackage->tourpackagecat_id == $tourpackagecat->id ? 'selected' : '' }}>
                            {{ $tourpackagecat->name }}</option>
                    @endforeach
                </select>
                @error('tourpackagecat_id')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- tourroute --}}
            <div class="mb-4">
                <label for="">Tour Routes</label>
                <a href="{{ route('tourroutes.index') }}" class="text-sm text-orange-500 hover:underline">tambah
                    tour route</a>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2">
                    @foreach ($tourroutes as $tourroute)
                        <div class="input">
                            <input type="checkbox" id="tourroute_{{ $tourroute->id }}" name="tourroutes[]"
                                value="{{ $tourroute->id }}"
                                {{ in_array($tourroute->id, $tourpackage->tourroutes->pluck('id')->toArray()) ? 'checked' : '' }}>
                            <label for="tourroute_{{ $tourroute->id }}">{{ $tourroute->name }}</label>
                        </div>
                    @endforeach
                </div>
                @error('tourroutes')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- status --}}
            <div class="mb-4">
                <label for="status">Status</label>
                <select class="select @error('status') !ring-red-500 @enderror" name="status" id="status">
                    <option value="1">-- Select Status</option>
                    <option value="active" {{ $tourpackage->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $tourpackage->status == 'inactive' ? 'selected' : '' }}>Inactive
                    </option>
                </select>
                @error('status')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <script>
                ClassicEditor
                    .create(document.querySelector('#detail'))
                    .catch(error => {
                        console.error(error);
                    });
                ClassicEditor
                    .create(document.querySelector('#price_detail'))
                    .catch(error => {
                        console.error(error);
                    });
                ClassicEditor
                    .create(document.querySelector('#itenary_detail'))
                    .catch(error => {
                        console.error(error);
                    });
                ClassicEditor
                    .create(document.querySelector('#policy_detail'))
                    .catch(error => {
                        console.error(error);
                    });
                ClassicEditor
                    .create(document.querySelector('#info_detail'))
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
            {{-- Current Images --}}
            @if ($tourpackage->tourimages->count() > 0)
                <div class="mb-4">
                    <label>Current Images</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-2">
                        @foreach ($tourpackage->tourimages as $image)
                            <div>
                                <img src="{{ asset('storage/' . $image->image_path) }}"
                                    alt="{{ $tourpackage->name ?? 'image' }}"
                                    class="w-full h-32 object-cover object-center rounded-lg">
                                <label>
                                    <input type="checkbox" name="delete_images[]" value="{{ $image->id }}">
                                    Delete
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Tour Images --}}
            <div class="mb-4">
                <label for="images">Add Tour Images</label>
                <input class="input" type="file" id="images" name="images[]" multiple accept="image/*"
                    onchange="previewImages(event, 'preview-container-update')">
                @error('images.*')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div id="preview-container-update" class="mb-4 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-2">
            </div>

            {{-- submit --}}
            <button type="submit"
                class="bg-orange-500 hover:bg-orange-600 transition py-2 px-6 rounded-full text-white">Save</button>
        </form>
    </div>
</x-authlayout>
