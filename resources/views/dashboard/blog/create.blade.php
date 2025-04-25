<x-layout>
    <div class="container">
        <h2 class="text-2xl font-semibold py-2 mt-4">Create New Blog</h2>

        {{-- Session Messages --}}
        @if (session('success'))
            <x-flash-msg message="{{ session('success') }}"></x-flash-msg>
        @endif

        <form action="{{ route('blog.store') }}" method="POST" class="mt-8" enctype="multipart/form-data">
            @csrf

            {{-- blog title --}}
            <div class="mb-4">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
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
                    @foreach ($blogCategories as $bc)
                        <option value="{{ $bc->id }}">{{ $bc->name }}</option>
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
                    class="input @error('content') !ring-red-500 @enderror">{{ old('content') }}</textarea>
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
            <button type="submit" class="btn">Create</button>
        </form>
    </div>
</x-layout>
