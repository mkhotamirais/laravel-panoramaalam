<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ env('APP_NAME', 'Laravel') }}</title>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="flex flex-col min-h-screen font-poppins">
    <header x-data="{ scrolled: false }" x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 50)"
        :class="scrolled ? 'bg-white shadow' : 'bg-transparent text-white'"
        class="h-16 lg:h-20 fixed top-0 w-full bg-transparent z-50 transition">
        <div class="container flex h-full justify-between items-center">
            <a href="{{ route('home') }}" class="w-64">
                <img src="{{ asset('storage/svg/panorama_alam_logo.svg') }}" alt="">
            </a>
            {{-- nav desktop --}}
            <div class="hidden lg:flex">
                <nav class="flex font-montserrat text-gray-600 text-md">
                    @foreach (config('menu') as $menu)
                        <a href="{{ route($menu['name']) }}" :class="scrolled ? 'text-gray-900' : 'text-white'"
                            class="{{ request()->routeIs($menu['name']) ? 'text-orange-400' : '' }} px-4 hover:text-orange-400 transition">{{ $menu['label'] }}</a>
                    @endforeach
                </nav>
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
                        @foreach (config('menu') as $menu)
                            <a href="{{ route($menu['name']) }}"
                                class="font-montserrat text-2xl p-4 text-white hover:text-orange-500 transition">{{ $menu['label'] }}</a>
                        @endforeach
                        <div class="mt-8">
                            <h3 class="text-center text-orange-500 mb-4">Hubungi Kami</h3>
                            <div class="h-[2px] w-12 bg-orange-500 rounded-full mx-auto mb-8"></div>
                            <div class="flex flex-row gap-8">
                                <a href="">
                                    <x-si-whatsapp class="w-8 h-8" />
                                </a>
                                <a href="">
                                    <x-si-instagram class="w-8 h-8" />
                                </a>
                                <a href="">
                                    <x-si-facebook class="w-8 h-8" />
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            {{-- contact us --}}
            <button
                class="hidden lg:flex px-5 py-3 rounded-full bg-orange-500 hover:bg-orange-600 transition items-center justify-center text-white">
                <x-si-whatsapp class="mr-2 w-5 h-5" />
                <span>Hubungi Kami</span>
            </button>
        </div>
    </header>

    <main class="grow">
        {{ $slot }}
    </main>

    <footer class="border-t bg-gradient-to-r from-orange-500/10 to-blue-500/10 pt-16 pb-8">
        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 place-items-baseline">
                <div class="space-y-4">
                    <h3>Logo</h3>
                    <p class="text-gray-600">Cari paket wisata lombok, rental mobil lombok, rental motor lombok dengan
                        harga terbaik di lombok
                    </p>
                    <p class="">
                        <x-si-maplibre class="w-5 h-5 min-w-fit mr-2 inline" /> Jln Raya Lembar-Gerung Lombok Barat
                        (Dekat dengan bundaran Gerung).
                    </p>
                </div>
                <div>
                    <h2 class="text-2xl font-semibold">Menu</h2>
                    <nav class="flex flex-col gap-2 mt-4">
                        @foreach (config('menu') as $menu)
                            <a href="{{ route($menu['name']) }}"
                                class="text-gray-600 hover:text-orange-400 transition }}">{{ $menu['label'] }}</a>
                        @endforeach
                    </nav>
                </div>
                <div>
                    <h2 class="text-2xl font-semibold">Hubungi Kami</h2>
                    <nav class="flex flex-col gap-2 mt-4">
                        <a href="" class="flex items-center gap-2">
                            <x-si-whatsapp class="w-5 h-5" />
                            <span>(+62) 895-1234-5678</span>
                        </a>
                        <a href="" class="flex items-center gap-2">
                            <x-si-instagram class="w-5 h-5" />
                            <span>panorama_alam</span>
                        </a>
                        <a href="" class="flex items-center gap-2">
                            <x-si-facebook class="w-5 h-5" />
                            <span>panorama_alam</span>
                        </a>
                    </nav>
                </div>
            </div>
            <p class="text-center font-bold mt-12">PT. Panorama Alam Bahagia</p>
        </div>
    </footer>
</body>

</html>
