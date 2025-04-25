@props(['title' => __('common.meta.home.title'), 'description' => __('common.meta.home.description')])

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('storage/img/panorama_icon.svg') }}" type="image/x-icon">

    <title>{{ $title ?: 'Panorama Alam' }}</title>
    <meta name="description" content="{{ $description ?: 'Paket wisata terbaik lombok' }}">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-SY0C85WWJP"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-SY0C85WWJP');
    </script>

    {{-- Swiper --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    {{-- CKEditor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    {{-- Alpine --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="flex flex-col min-h-screen font-poppins">
    <header class="bg-white h-[4.6rem] sticky top-0 w-full z-50 transition">
        <div class="container flex h-full justify-between items-center">
            <x-logo />

            <div class="flex items-center">
                {{-- nav desktop --}}
                <div class="hidden lg:flex items-center">
                    <nav class="flex text-gray-600 text-md mr-8">
                        @foreach (__('common.main-menu') as $menu)
                            <a href="{{ route($menu['name']) }}"
                                class="{{ request()->routeIs($menu['name']) ? 'text-orange-400' : '' }} font-medium px-3 hover:text-orange-400 transition">{{ $menu['label'] }}</a>
                        @endforeach
                    </nav>
                    {{-- contact us --}}
                    <a href="{{ config('common.links.wa-href') }}" class="btn lg:py-3 px-5">
                        <x-si-whatsapp class="w-5 h-5" />
                        <span>{{ __('common.common.contact-btn') }}</span>
                    </a>
                    {{-- language --}}
                    <x-lang />
                </div>

                {{-- auth --}}
                @auth
                    <div x-cloak x-data="{ open: false }" class="flex mx-2">
                        <button x-on:click="open = true"
                            class="p-3 bg-gray-100 rounded-full hover:bg-gray-200 transition-all">
                            <x-fas-user class="w-5 h-5" />
                        </button>
                        <div x-on:click="open = false" class="fixed inset-0 z-50 bg-black/20 transition-all"
                            :class="open ? 'visible opacity-100' : 'invisible opacity-0'">
                            <div x-on:click="e => e.stopPropagation()"
                                class="absolute w-80 border-l h-full bg-white right-0 transition-all"
                                :class="open ? 'translate-x-0' : 'translate-x-full'">
                                <div class="flex items-center justify-between p-3">
                                    <div class="px-3">
                                        Halo, <b>{{ auth()->user()->name }}</b>
                                    </div>
                                    <button x-on:click="open = false" class="p-2 rounded-lg hover:bg-gray-100">
                                        <x-bi-x-lg class="w-5 h-5" />
                                    </button>
                                </div>
                                <div class="px-6 space-y-3">
                                    @foreach (config('common.dashboard-menu') as $menu)
                                        @if ($menu['name'] !== '')
                                            <a href="{{ route($menu['name']) }}" x-on:click="open = false"
                                                class="block {{ request()->routeIs($menu['name']) ? 'text-orange-400' : 'text-gray-600 hover:text-orange-500' }}">{{ $menu['label'] }}</a>
                                        @else
                                            <p class="font-semibold mt-3">{{ $menu['label'] }}</p>
                                        @endif
                                    @endforeach

                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="block text-red-600 hover:text-red-500">Logout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endauth

                {{-- nav mobile --}}
                <div x-cloak x-data="{ open: false }" class="lg:hidden flex">
                    <button @click="open = !open" class="flex">
                        <x-fas-bars class="w-7 h-7" />
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                        class="lg:hidden flex items-center justify-center fixed inset-0 z-50 bg-blue-600/90">
                        <button @click="open = false" class="absolute right-10 top-10 hover:text-red-500">
                            <x-bi-x-lg class="w-8 h-8" />
                        </button>

                        <nav class="flex flex-col justify-center items-center">
                            <div>
                                <x-lang />
                            </div>
                            @foreach (__('common.main-menu') as $menu)
                                <a href="{{ route($menu['name']) }}"
                                    class="{{ request()->routeIs($menu['name']) ? 'text-orange-400' : 'text-white' }} font-montserrat text-2xl p-4 hover:text-orange-500 transition">{{ $menu['label'] }}</a>
                            @endforeach
                            <div class="mt-8">
                                <h3 class="text-center text-orange-500 mb-4">{{ __('common.common.contact-btn') }}</h3>
                                <div class="h-[2px] w-12 bg-orange-500 rounded-full mx-auto mb-8"></div>
                                <div class="flex flex-row gap-8">
                                    <a href="http://api.whatsapp.com/send?phone=6281319573240" class="text-white">
                                        <x-si-whatsapp class="w-8 h-8" />
                                    </a>
                                    <a href="https://www.instagram.com/panoramaalamid?igsh=MXYyMHFndm9vNGgwbA=="
                                        class="text-white">
                                        <x-si-instagram class="w-8 h-8" />
                                    </a>
                                    <a href="https://www.facebook.com/profile.php?id=100089579831759"
                                        class="text-white">
                                        <x-si-facebook class="w-8 h-8" />
                                    </a>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>

            </div>

        </div>
    </header>

    <main class="grow">
        {{ $slot }}
    </main>

    <div class="fixed bottom-0 right-0 pr-6 lg:pb-8 lg:pr-12 pb-6 flex !z-50">
        <a href="{{ config('common.links.wa-href') }}" class="flex items-center hover:scale-105 transition">
            <x-fab-whatsapp class="size-14 text-green-600" />
        </a>
    </div>

    <footer class="pt-16 pb-6 bg-gradient-to-b from-white to-gray-500/10">
        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-8">
                <div class="space-y-4">
                    <x-logo />
                    <p class="text-gray-600">{{ __('common.home.hero.title') }}</p>
                    {{-- <x-si-maplibre class="w-5 h-5 min-w-fit mr-2 inline" /> Address --}}
                    <address>{{ config('common.address') }}</address>
                </div>
                <div>
                    <h2 class="text-2xl font-semibold">{{ __('common.footer.links') }}</h2>
                    <nav class="flex flex-col gap-2 mt-4">
                        @foreach (__('common.main-menu') as $menu)
                            <a href="{{ route($menu['name']) }}"
                                class="{{ request()->routeIs($menu['name']) ? 'text-orange-400' : 'text-gray-600' }} hover:text-orange-400 transition w-fit">{{ $menu['label'] }}</a>
                        @endforeach
                    </nav>
                </div>
                <div>
                    <h2 class="text-2xl font-semibold">{{ __('common.footer.other-links') }}</h2>
                    <nav class="flex flex-col gap-2 mt-4">
                        @foreach (__('common.footer.other-links-menu') as $menu)
                            <a href="{{ $menu['href'] }}"
                                class="text-gray-600 hover:text-orange-400 transition w-fit">{{ $menu['label'] }}</a>
                        @endforeach
                    </nav>
                </div>
                <div>
                    <div class="mb-12">
                        <h2 class="text-2xl font-semibold">{{ __('common.common.contact-btn') }}</h2>
                        <nav class="flex flex-col gap-2 mt-4">
                            <a href="https://api.whatsapp.com/send?phone=6281319573240"
                                class="flex items-center gap-2">
                                <x-si-whatsapp class="w-5 h-5" />
                                <span>(+62) 813-1957-3240</span>
                            </a>
                            <a href="https://www.instagram.com/panoramaalamid?igsh=MXYyMHFndm9vNGgwbA=="
                                class="flex items-center gap-2">
                                <x-si-instagram class="w-5 h-5" />
                                <span>@panoramaalamid</span>
                            </a>
                            <a href="https://www.facebook.com/profile.php?id=100089579831759"
                                class="flex items-center gap-2">
                                <x-si-facebook class="w-5 h-5" />
                                <span>@panoramaalam</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
            <p class="text-center font-bold mt-12">PT. Panorama Alam Bahagia</p>
            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit" href="" class="text-xs w-full text-gray-200">Logout</button>
                </form>
            @endauth
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const images = document.querySelectorAll("img");
            images.forEach((img) => {
                img.oncontextmenu = () => false;
            });
        });
    </script>

</body>

</html>
