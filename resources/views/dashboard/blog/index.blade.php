<x-authlayout>
    <div class="container py-4">
        <h1 class="title">Blog List</h1>

        <h2 class="text-2xl font-semibold mt-3 py-2">Your Blogs ({{ $myBlogs->total() }})</h2>
        <a href="{{ route('blogs.create') }}"
            class="bg-orange-500 hover:bg-orange-600 py-2 px-4 rounded-full text-white inline-block my-2">Add New
            Blog</a>

        @if (session('success'))
            <x-flash-msg message="{{ session('success') }}" bg="bg-green-500"></x-flash-msg>
        @endif

        <div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                @foreach ($myBlogs as $blog)
                    <x-blog-card :blog="$blog">
                        <div class="mt-auto flex justify-end gap-1 items-center bg-gray-100 p-2 border-t">
                            {{-- update blog --}}
                            <a href="{{ route('blogs.edit', $blog) }}"
                                class="bg-green-500 hover:bg-green-600 py-1 px-3 rounded-full text-white text-sm">Ubah</a>
                            {{-- delete blog --}}
                            <form action="{{ route('blogs.destroy', $blog) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 py-1 px-3 rounded-full text-white text-sm">Hapus</button>
                            </form>
                        </div>
                    </x-blog-card>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $myBlogs->links() }}
            </div>
        </div>

        <h1 class="text-2xl font-semibold mt-3 py-2">All Blog ({{ $blogs->total() }})</h1>

        <div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                @foreach ($blogs as $blog)
                    <x-blog-card :blog="$blog"></x-blog-card>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $blogs->links() }}
            </div>
        </div>
    </div>
</x-authlayout>
