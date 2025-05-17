@props(['blog' => [], 'full' => false, 'route' => 'blog.show', 'fullblog' => true])

<div class="relative shadow hover:shadow-lg transition rounded-lg overflow-hidden flex flex-col">
    <img src="{{ $blog->banner ? asset('storage/' . $blog->banner) : asset('storage/img/panorama_icon.svg') }}"
        loading="lazy" alt="{{ $blog->title ?? 'blog banner' }}"
        class="object-cover object-center w-full h-56 bg-gray-100">

    <div class="p-4 flex flex-col grow bg-white">
        <a href="{{ route($route, $blog) }}" class="card-title">
            {{ Str::words($blog->title, 6, '...') }}
        </a>
        <div class="text-xs text-gray-500 mt-2">
            <span class="capitalize">{{ $blog->blogcat->name }}</span> |
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
                    class="text-orange-500 hover:underline block text-sm mt-4 w-fit">{{ __('common.blog.read-more-btn') }}</a>
                {{-- @endif --}}
        @endif
    </div>

    {{ $slot }}
</div>
