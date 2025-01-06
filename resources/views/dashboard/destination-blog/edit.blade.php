<x-authlayout>
    <div class="container">
        <h2 class="text-2xl font-semibold py-2 mt-4">Update Destination Blog</h2>
        {{-- Session Messages --}}
        @if (session('success'))
            <x-flash-msg message="{{ session('success') }}"></x-flash-msg>
        @endif

        <form action="{{ route('destinationblogs.update', $destinationblog) }}" method="POST" class="mt-8"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- destinationblog title --}}
            <div class="mb-4">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ $destinationblog->title }}"
                    class="input @error('title') !ring-red-500 @enderror">
                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- destinationblog content --}}
            <div class="mb-4">
                <label for="content">Content</label>
                <textarea name="content" id="content" cols="30" rows="10"
                    class="input @error('content') !ring-red-500 @enderror">{{ $destinationblog->content }}</textarea>
                @error('content')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <script>
                ClassicEditor
                    .create(document.querySelector('#content'))
                    .catch(error => {
                        console.error(error);
                    });
            </script>

            {{-- current cover photo if exist --}}
            @if ($destinationblog->banner)
                <label>Current banner</label>
                <figure class="h-40 w-64 rounded-md mb-4 overflow-hidden">
                    <img src="{{ asset('storage/' . $destinationblog->banner) }}"
                        alt="{{ $destinationblog->title ?? 'destinationblog image' }}" width="400" height="400"
                        class="w-full h-full object-cover origin-center">
                </figure>
            @endif

            {{-- destinationblog banner --}}
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
                class="bg-orange-500 hover:bg-orange-600 transition py-2 px-6 rounded-full text-white">Save</button>
        </form>
    </div>
</x-authlayout>
