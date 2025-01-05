@props(['blog' => [], 'full' => false])

<div class="relative shadow hover:shadow-lg transition rounded overflow-hidden flex flex-col">
    {{-- cover photo --}}
    <img src="{{ $blog->banner ? asset('storage/' . $blog->banner) : asset('storage/svg/panorama_icon.svg') }}"
        alt="{{ $blog->title ?? 'blog banner' }}" class="object-cover object-center w-full h-56 bg-gray-100">

    <x-badge-cat-corner :route="'category-blogs'" :cat="$blog->blogcat" />

    <div class="p-6 flex flex-col grow bg-white">
        {{-- title --}}
        <a href="{{ route('blogs.show', $blog) }}">
            <h2 class="text-xl lg:text-2xl hover:underline font-semibold capitalize">{{ $blog->title }}</h2>
        </a>
        {{-- author and date --}}
        <div class="text-xs text-gray-500 mt-2">
            <span>
                Posted by <a href="{{ route('user-blogs', $blog->user->username) }}"
                    class="text-orange-500 capitalize hover:underline">{{ $blog->user->username }}</a>
            </span>

            <span>
                in
                @if ($blog->blogcat)
                    <a href="{{ route('category-blogs', $blog->blogcat->slug) }}"
                        class="text-orange-500 hover:underline">{{ $blog->blogcat->name }}</a>
                @else
                    <span>no category</span>
                @endif
            </span>

            <span>{{ $blog->created_at->diffForHumans() }}</span>
        </div>
        {{-- content --}}
        @if ($full)
            <div class="text-content text-sm grow">{{ $blog->content }}</d>
            @else
                <div class="text-content text-sm grow">
                    {{-- {{ Str::words($blog->content, 24, '...') }} --}}
                    {!! Str::words($blog->content, 24, '...') !!}
                </div>
                {{-- @if (Str::wordCount($blog->content) > 24) --}}
                <a href="{{ route('blogs.show', $blog) }}"
                    class="text-orange-500 hover:underline block text-sm mt-4 w-fit">Baca
                    Selengkapnya</a>
                {{-- @endif --}}
        @endif
    </div>

    {{ $slot }}
</div>
