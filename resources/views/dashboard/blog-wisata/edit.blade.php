<x-authlayout>
    <div class="container">
        <h2 class="text-2xl font-semibold py-2 mt-4">Update Blog</h2>

        {{-- Session Messages --}}
        @if (session('success'))
            <x-flash-msg message="{{ session('success') }}"></x-flash-msg>
        @endif

        <form action="{{ route('blogs.update', $blog) }}" method="POST" class="mt-8" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- blog title --}}
            <div class="mb-4">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ $blog->title }}"
                    class="input @error('title') !ring-red-500 @enderror">
                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- blog body --}}
            <div class="mb-4">
                <label for="body">Body</label>
                <textarea name="body" id="body" cols="30" rows="10"
                    class="input @error('body') !ring-red-500 @enderror">{{ $blog->body }}</textarea>
                @error('body')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- current cover photo if exist --}}
            @if ($blog->image)
                <label>Current cover photo</label>
                <figure class="h-40 w-64 rounded-md mb-4 overflow-hidden">
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title ?? 'blog image' }}"
                        width="400" height="400" class="w-full h-full object-cover origin-center">
                </figure>
            @endif

            <div class="mb-4">
                <label for="image">Cover Foto</label>
                <input type="file" name="image" id="image">
                @error('image')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- submit --}}
            <button type="submit"
                class="bg-orange-500 hover:bg-orange-600 transition py-2 px-6 rounded-full text-white">Save</button>
        </form>
    </div>
</x-authlayout>
