<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('storage/svg/panorama_icon.svg') }}" type="image/x-icon">

    <title>{{ env('APP_NAME', 'Laravel') }}</title>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="flex flex-col min-h-screen font-poppins">
    <header class="bg-white h-[4.6rem] sticky top-0 w-full z-50 transition">
        <div class="container flex h-full justify-between items-center">
            <x-logo />
            {{-- nav desktop --}}
            <div class="hidden lg:flex items-center">
                <nav class="flex text-gray-600 text-md mr-8">
                    @foreach (__('menu.header.main-menu') as $menu)
                        <a href="{{ route($menu['name']) }}"
                            class="{{ request()->routeIs($menu['name']) ? 'text-orange-400' : '' }} font-medium px-3 hover:text-orange-400 transition">{{ $menu['label'] }}</a>
                    @endforeach
                </nav>
                {{-- contact us --}}
                <a href="http://api.whatsapp.com/send?phone=6281319573240"
                    class="min-w-fit hidden lg:flex px-5 py-3 rounded-full bg-orange-500 hover:bg-orange-600 transition items-center justify-center text-white">
                    <x-si-whatsapp class="mr-2 w-5 h-5" />
                    <span>{{ __('menu.header.contact-btn') }}</span>
                </a>
                {{-- language --}}
                <x-lang />
            </div>
            {{-- nav mobile --}}
            <div x-data="{ open: false }" class="lg:hidden flex">
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
                        @foreach (__('menu.header.main-menu') as $menu)
                            <a href="{{ route($menu['name']) }}"
                                class="font-montserrat text-2xl p-4 text-white hover:text-orange-500 transition">{{ $menu['label'] }}</a>
                        @endforeach
                        <div class="mt-8">
                            <h3 class="text-center text-orange-500 mb-4">{{ __('menu.header.contact-btn') }}</h3>
                            <div class="h-[2px] w-12 bg-orange-500 rounded-full mx-auto mb-8"></div>
                            <div class="flex flex-row gap-8">
                                <a href="http://api.whatsapp.com/send?phone=6281319573240" class="text-white">
                                    <x-si-whatsapp class="w-8 h-8" />
                                </a>
                                <a href="https://www.instagram.com/panoramaalamid?igsh=MXYyMHFndm9vNGgwbA=="
                                    class="text-white">
                                    <x-si-instagram class="w-8 h-8" />
                                </a>
                                <a href="https://www.facebook.com/profile.php?id=100089579831759" class="text-white">
                                    <x-si-facebook class="w-8 h-8" />
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <main class="grow">
        {{ $slot }}
        <div x-data="{ visible: false, timeout: null }" x-init="window.addEventListener('scroll', () => {
            visible = true;
            clearTimeout(timeout);
            timeout = setTimeout(() => visible = false, 2000);
        })" :class="visible ? 'translate-x-0' : 'translate-x-full'"
            class="fixed bottom-0 right-0 pr-6 pb-6 flex lg:hidden transition-transform duration-300"
            @mouseenter="clearTimeout(timeout)" @mouseleave="timeout = setTimeout(() => visible = false, 2000)">
            <a href="http://api.whatsapp.com/send?phone=6281319573240"
                class="flex items-center hover:scale-105 transition">
                <img src="https://raw.githubusercontent.com/grommet/grommet-icons/master/public/img/whatsapp.svg"
                    alt="" class="size-12">
            </a>
        </div>
    </main>

    <footer class="pt-16 pb-8 bg-gradient-to-b from-white to-gray-500/10">
        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="space-y-4">
                    <x-logo />
                    <p class="text-gray-600">{{ __('menu.footer.description') }}
                    </p>
                    <p class="">
                        <x-si-maplibre class="w-5 h-5 min-w-fit mr-2 inline" /> {{ __('menu.footer.address') }}
                    </p>
                </div>
                <div>
                    <h2 class="text-2xl font-semibold">Menu</h2>
                    <nav class="flex flex-col gap-2 mt-4">
                        @foreach (__('menu.header.main-menu') as $menu)
                            <a href="{{ route($menu['name']) }}"
                                class="text-gray-600 hover:text-orange-400 transition }}">{{ $menu['label'] }}</a>
                        @endforeach
                    </nav>
                </div>
                <div>
                    <h2 class="text-2xl font-semibold">{{ __('menu.footer.contact-title') }}</h2>
                    <nav class="flex flex-col gap-2 mt-4">
                        <a href="http://api.whatsapp.com/send?phone=6281319573240" class="flex items-center gap-2">
                            <x-si-whatsapp class="w-5 h-5" />
                            <span>(+62) 813-1957-3240</span>
                        </a>
                        <a href="https://www.instagram.com/panoramaalamid?igsh=MXYyMHFndm9vNGgwbA=="
                            class="flex items-center gap-2">
                            <x-si-instagram class="w-5 h-5" />
                            <span>@panoramaalam</span>
                        </a>
                        <a href="https://www.facebook.com/profile.php?id=100089579831759"
                            class="flex items-center gap-2">
                            <x-si-facebook class="w-5 h-5" />
                            <span>@panoramaalam</span>
                        </a>
                    </nav>
                </div>
            </div>
            <p class="text-center font-bold mt-12">PT. Panorama Alam Bahagia</p>
        </div>
    </footer>
</body>

</html>
