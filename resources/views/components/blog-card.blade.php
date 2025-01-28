@props(['blog' => [], 'full' => false, 'route' => 'blogs.show', 'fullblog' => true])

<div class="relative shadow hover:shadow-lg transition rounded-lg overflow-hidden flex flex-col">
    {{-- cover photo --}}
    <img src="{{ $blog->banner ? asset('storage/' . $blog->banner) : asset('storage/svg/panorama_icon.svg') }}"
        alt="{{ $blog->title ?? 'blog banner' }}" class="object-cover object-center w-full h-56 bg-gray-100">

    {{-- @if ($fullblog)
        <x-badge-cat-corner :route="'category-blogs'" :cat="$blog->blogcat" />
    @endif --}}

    <div class="p-4 flex flex-col grow bg-white">
        {{-- title --}}
        <a href="{{ route($route, $blog) }}" class="card-title">
            {{ Str::words($blog->title, 6, '...') }}
        </a>
        {{-- author and date --}}
        <div class="text-xs text-gray-500 mt-2">
            @if ($fullblog)
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
            @endif

            <span>{{ $blog->created_at->diffForHumans() }}</span>
        </div>
        {{-- content --}}
        @if ($full)
            <div class="text-content text-sm grow">{{ $blog->content }}</d>
            @else
                <div class="text-content text-sm grow">
                    {{-- {{ Str::words($blog->content, 24, '...') }} --}}
                    {!! Str::words($blog->content, 16, '...') !!}
                </div>
                {{-- @if (Str::wordCount($blog->content) > 24) --}}
                <a href="{{ route($route, $blog) }}"
                    class="text-orange-500 hover:underline block text-sm mt-4 w-fit">{{ __('menu.blog.read-more-btn') }}</a>
                {{-- @endif --}}
        @endif
    </div>

    {{ $slot }}
</div>
