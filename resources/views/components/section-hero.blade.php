@props(['title' => 'PANORAMA ALAM', 'height' => 'h-[40vh]', 'banner' => 'storage/img/unsplash_home_hero_bg.avif'])

<section id="hero" class="relative {{ $height }} w-full bg-gradient-to-b from-black/30 to-black/60">
    <img src="{{ asset($banner) }}" alt="panoramaalam home hero"
        class="absolute w-full object-cover object-center {{ $height }} -z-10">
    <div class="container text-white h-full flex items-center w-full">
        <div class="max-w-screen-sm leading-relaxed w-full">
            <h1 class="text-4xl lg:text-5xl font-semibold capitalize">{{ $title }}</h1>
            {{ $slot }}
        </div>
    </div>
</section>
