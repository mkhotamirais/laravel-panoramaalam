@props(['destinationblogs' => []])

<section class="py-16">
    <div class="container">
        <div>
            <h3 class="up-title">{{ __('menu.home.destination.title') }}</h3>
            <div class="h-[3px] bg-orange-500 w-16 rounded-full my-2"></div>
            <h1 class="title leading-tight">{{ __('menu.home.destination.big-title') }}</h1>
        </div>
        <x-blog-destination :destinationblogs="$destinationblogs"></x-blog-destination>
        <div class="flex items-center mt-8">
            <a href="{{ route('destination-blog') }}"
                class="btn lg:py-3 px-5">{{ __('menu.home.destination.all-destination-btn') }}</a>
        </div>
    </div>
</section>
