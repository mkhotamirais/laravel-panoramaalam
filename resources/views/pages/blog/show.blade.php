<x-layout :title="Str::words($blog->title, 10, '...')" description="{!! Str::words(strip_tags(html_entity_decode($blog->content)), 25, '...') !!}">
    <div class="pb-16 pt-0 lg:pt-16">
        <div class="max-w-screen-lg mx-auto">
            <div class="flex flex-col">
                <div class="mb-8 text-center hidden lg:block">
                    {{-- title --}}
                    <h2 class="text-5xl font-semibold capitalize">{{ $blog->title }}</h2>
                    {{-- author and date --}}
                    <div class="text-gray-500 mt-2">
                        <span>
                            {{ $blog->created_at->diffForHumans() }} {{ __('common.blog.show.post-detail.2') }}
                            {{ $blog->blogcat->name ?: 'panorama blog' }}
                        </span>
                    </div>

                </div>
                {{-- cover photo --}}
                <img src="{{ $blog->banner ? asset('storage/' . $blog->banner) : asset('storage/svg/panorama_icon.svg') }}"
                    alt="{{ $blog->title ?? 'blog banner' }}"
                    class="object-cover object-center aspect-[16/9] rounded-none lg:rounded-lg bg-gray-100">

                <div class="flex flex-col px-4 lg:px-0 mt-4 max-w-screen-sm mr-auto">
                    <div class="block lg:hidden">
                        {{-- title --}}
                        <h2 class="text-3xl font-semibold capitalize">{{ $blog->title }}</h2>
                        {{-- author and date --}}
                        <div class="text-sm text-gray-600">
                            <span>{{ $blog->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    {{-- content --}}
                    <div class="text-content">{!! $blog->content !!}</div>
                </div>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="flex justify-between items-center py-2 mt-4 mb-2">
            <h2 class="text-2xl font-semibold mr-2">{{ __('common.blog.show.others') }}</h2>
            <a href="{{ route('blog') }}" class="text-orange-500 min-w-max hover:underline flex gap-2 items-center">
                <span>{{ __('common.common.view-all') }}</span>
                <x-bi-arrow-right class="w-4 flex" />
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2 lg:gap-4 mb-8">
            @foreach ($latestThreeBlogs as $blog)
                <x-blog-card :blog="$blog"></x-blog-card>
            @endforeach
        </div>
    </div>
</x-layout>
