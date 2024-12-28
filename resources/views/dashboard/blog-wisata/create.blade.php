<x-authlayout>
    <div class="container">
        <h2 class="text-2xl font-semibold py-2 mt-4">Create New Blog</h2>

        {{-- Session Messages --}}
        @if (session('success'))
            <x-flash-msg message="{{ session('success') }}"></x-flash-msg>
        @endif

        <form action="{{ route('blogs.store') }}" method="POST" class="mt-8" enctype="multipart/form-data">
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

            {{-- blog category --}}
            <div class="mb-4">
                <label for="blogCategory">Category</label>
                <a href="{{ route('blog-categories.index') }}" class="text-sm text-orange-500 hover:underline">tambah
                    category</a>
                <select class="select @error('title') !ring-red-500 @enderror" name="blogCategory" id="blogCategory">
                    <option value="">-- Select Category</option>
                    @foreach ($blogCategories as $bc)
                        <option value="{{ $bc->id }}">{{ $bc->name }}</option>
                    @endforeach
                </select>
                @error('blogCategory')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- blog body --}}
            <div class="mb-4">
                <label for="body">Body</label>
                <textarea name="body" id="body" cols="30" rows="10"
                    class="input @error('body') !ring-red-500 @enderror">{{ old('body') }}</textarea>
                @error('body')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- blog image --}}
            <div class="mb-4">
                <label for="image">Cover Photo</label>
                <input type="file" name="image" id="image"
                    class="input @error('image') !ring-red-500 @enderror">
                @error('image')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>


            {{-- submit --}}
            <button type="submit"
                class="bg-orange-500 hover:bg-orange-600 transition py-2 px-6 rounded-full text-white">Create</button>
        </form>
    </div>
</x-authlayout>
