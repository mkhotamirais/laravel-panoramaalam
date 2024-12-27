@props(['blog' => [], 'full' => false])

<div class="shadow hover:shadow-lg transition rounded overflow-hidden flex flex-col">
    {{-- cover photo --}}
    <img src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('storage/svg/panorama_icon.svg') }}"
        alt="{{ $blog->title ?? 'blog image' }}" class="object-cover object-center w-full h-56 bg-gray-100">

    <div class="p-6 flex flex-col grow bg-white">
        {{-- title --}}
        <a href="{{ route('blogs.show', $blog) }}">
            <h2 class="text-xl lg:text-2xl hover:underline font-semibold capitalize">{{ $blog->title }}</h2>
        </a>
        {{-- author and date --}}
        <div class="text-sm text-gray-600">
            <p>Posted by <a href="{{ route('user.blogs', $blog->user->username) }}"
                    class="text-orange-500 capitalize hover:underline">{{ $blog->user->username }}</a>
                in
                <a href="{{ route('blog-category.blogs', $blog->blogCategory->name) }}"
                    class="text-orange-500 hover:underline">{{ $blog->blogCategory->name }}</a>
                {{ $blog->created_at->diffForHumans() }}
            </p>
        </div>
        {{-- content --}}
        @if ($full)
            <p class="text-gray-800 mt-4 grow">{{ $blog->body }}</p>
        @else
            <p class="text-sm text-gray-800 mt-4 grow leading-relaxed">
                {{ Str::words($blog->body, 24, '...') }}
            </p>
            {{-- @if (Str::wordCount($blog->body) > 24) --}}
            <a href="{{ route('blogs.show', $blog) }}" class="text-orange-500 hover:underline block text-sm mt-4">Baca
                Selengkapnya</a>
            {{-- @endif --}}
        @endif
    </div>

    {{ $slot }}
</div>
