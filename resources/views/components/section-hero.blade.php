@props([
    'title' => __('common.home.hero.title'),
    'height' => 'h-[40vh]',
    'banner' => 'storage/img/unsplash_home_hero_bg.avif',
    'total' => 0,
])

<section id="hero" class="relative {{ $height }} w-full bg-gradient-to-b from-black/30 to-black/60">
    {{-- <img src="{{ asset($banner) }}" alt="panoramaalam hero" loading="lazy"
        class="absolute w-full object-cover object-center {{ $height }} -z-10"> --}}
    <div class="container text-white h-full flex items-center w-full">
        <div class="max-w-4xl leading-relaxed w-full">
            <h1 class="text-4xl lg:text-6xl font-semibold capitalize">{{ $title }}
                {{ $total > 0 ? ' (' . $total . ')' : '' }}</h1>
            {{ $slot }}
        </div>
    </div>
</section>
