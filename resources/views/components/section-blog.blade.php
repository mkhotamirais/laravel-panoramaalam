@props(['blogs' => [], 'bg' => 'bg-white'])

<section class="py-16 {{ $bg }}">
    <div class="container">
        <div>
            <h3 class="up-title">{{ __('common.home.blogs.title') }}</h3>
            <div class="h-[3px] bg-orange-500 w-16 rounded-full my-2"></div>
            <h1 class="title leading-tight max-w-4xl">{{ __('common.home.blogs.big-title') }}</h1>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-8">
            @foreach ($blogs as $blog)
                <x-blog-card :blog="$blog"></x-blog-card>
            @endforeach
        </div>
        <div class="flex items-center mt-8">
            <a href="{{ route('blog') }}" class="btn">{{ __('common.common.view-all') }}</a>
        </div>
    </div>
</section>
