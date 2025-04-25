@props(['destinationblogs' => [], 'bg' => 'bg-white'])

<section class="py-16 {{ $bg }}">
    <div class="container">
        <div>
            <h3 class="up-title">{{ __('common.home.destination.title') }}</h3>
            <div class="h-[3px] bg-orange-500 w-16 rounded-full my-2"></div>
            <h1 class="title leading-tight max-w-4xl">{{ __('common.home.destination.big-title') }}</h1>
        </div>
        <div class="swiper my-4">
            <div class="card-wrapper relative pb-8 pt-0 lg:pt-4">
                <div class="card-list swiper-wrapper">
                    @foreach ($destinationblogs as $destinationblog)
                        <a href="{{ route('blog.show', $destinationblog) }}"
                            class="swiper-slide h-[30vh] relative group rounded-xl overflow-hidden">
                            {{-- <h1
                                class="z-10 text-2xl capitalize font-semibold absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2 text-center text-white">
                                {{ $destinationblog->title }}</h1> --}}
                            <img src="{{ $destinationblog->banner ? asset('storage/' . $destinationblog->banner) : asset('storage/svg/panorama_icon.svg') }}"
                                alt="{{ $destinationblog->title ?? 'blog banner' }}"
                                class="object-cover object-center w-full h-56 bg-gray-100">
                            <div class="absolute inset-0 bg-black/30 group-hover:bg-black/10 transition"></div>
                        </a>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>

                <div class="swiper-slide-button swiper-button-prev">
                    <x-bi-arrow-left-circle />
                </div>
                <div class="swiper-slide-button swiper-button-next">
                    <x-bi-arrow-right-circle />
                </div>
            </div>
        </div>

        {{-- <div class="flex items-center mt-8">
            <a href="{{ route('destination-blog') }}"
                class="btn lg:py-3 px-5">{{ __('common.home.destination.all-destination-btn') }}</a>
        </div> --}}
    </div>
</section>
