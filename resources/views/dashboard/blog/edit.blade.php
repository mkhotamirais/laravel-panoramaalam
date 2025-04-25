<x-layout>
    <div class="container">
        <h2 class="text-2xl font-semibold py-2 mt-4">Update Blog</h2>
        {{-- Session Messages --}}
        @if (session('success'))
            <x-flash-msg message="{{ session('success') }}"></x-flash-msg>
        @endif

        <form action="{{ route('blog.update', $blog) }}" method="POST" class="mt-8" enctype="multipart/form-data">
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

            {{-- blog cat --}}
            <div class="mb-4">
                <label for="blogcat_id">Category</label>
                <a href="{{ route('blogcats.index') }}" class="text-sm text-orange-500 hover:underline">tambah
                    category</a>
                <select class="select @error('blogcat_id') !ring-red-500 @enderror" name="blogcat_id" id="blogcat_id">
                    <option value="1">-- Select Category</option>
                    @foreach ($blogcats as $blogcat)
                        <option value="{{ $blogcat->id }}" {{ $blog->blogcat_id == $blogcat->id ? 'selected' : '' }}>
                            {{ $blogcat->name }}</option>
                    @endforeach
                </select>
                @error('blogcat_id')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- blog content --}}
            <div class="mb-4">
                <label for="content">Content</label>
                <textarea name="content" id="content" cols="30" rows="10"
                    class="input @error('content') !ring-red-500 @enderror">{{ $blog->content }}</textarea>
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
            @if ($blog->banner)
                <label>Current banner</label>
                <figure class="h-40 w-64 rounded-md mb-4 overflow-hidden">
                    <img src="{{ asset('storage/' . $blog->banner) }}" alt="{{ $blog->title ?? 'blog image' }}"
                        width="400" height="400" class="w-full h-full object-cover origin-center">
                </figure>
            @endif

            {{-- blog banner --}}
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
</x-layout>
