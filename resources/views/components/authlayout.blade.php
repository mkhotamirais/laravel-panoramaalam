<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('storage/img/panorama_icon.svg') }}" type="image/x-icon">

    <title>{{ env('APP_NAME', 'Laravel') }}</title>

    {{-- Swiper --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    {{-- CKEditor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    {{-- Alpine --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col font-poppins">
    <header class="h-16 border-b sticky top-0 bg-white z-50">
        <div class="px-4 lg:px-8 h-full">
            <div class="flex justify-between items-center h-full">
                <div class="flex items-center gap-2">
                    @auth
                        <div x-data="{
                            open: false,
                            updateOpenState() {
                                this.open = window.innerWidth >= 1024;
                            }
                        }" x-init="updateOpenState();
                        window.addEventListener('resize', updateOpenState)" class="relative flex">
                            <button @click="open = !open" class="lg:hidden">
                                <x-bi-x-lg class="w-6 h-6" x-show="open" />
                                <x-fas-bars class="w-6 h-6" x-show="!open" />
                            </button>
                            <div x-show="open" x-transition:enter="transition transform ease-out duration-300"
                                x-transition:enter-start="-translate-x-full opacity-0"
                                x-transition:enter-end="translate-x-0 opacity-100"
                                x-transition:leave="transition transform ease-in duration-300"
                                x-transition:leave-start="translate-x-0 opacity-100"
                                x-transition:leave-end="-translate-x-full opacity-0"
                                @click.outside="if (window.innerWidth < 1024) open = false"
                                class="fixed w-72 left-0 top-16 bottom-0 bg-white p-4 border-r lg:translate-x-0 overflow-auto">
                                <div class="flex flex-col gap-2">
                                    <h2 class="text-xl font-semibold">Admin Dashboard</h2>
                                    @foreach (config('common.dashboard-menu') as $menu)
                                        @if ($menu['name'] !== '')
                                            <a href="{{ route($menu['name']) }}"
                                                class="{{ request()->routeIs($menu['name']) ? 'text-orange-400' : 'text-gray-600 hover:text-orange-500' }}">{{ $menu['label'] }}</a>
                                        @else
                                            <p class="font-semibold mt-3">{{ $menu['label'] }}</p>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endauth
                    <x-logo />
                </div>

                @auth
                    <nav x-data="{ open: false }" class="relative" @mouseover="open = true" @mouseleave="open = false">
                        <button class="rounded-full bg-gray-100 flex items-center justify-center size-10">
                            <x-far-user class="w-4 h-4" />
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                            class="absolute right-0 top-full min-w-max">
                            <div class="mt-4 p-4 border shadow-lg rounded-md bg-white">
                                <div class="pb-2 border-b-2 border-orange-500 text-sm">Halo
                                    <span>{{ auth()->user()->username }}</span>
                                </div>
                                <a href="{{ route('dashboard') }}"
                                    class="py-2 block my-2 hover:text-orange-500">Dashboard</a>
                                {{-- logout --}}
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf

                                    <button type="submit" href=""
                                        class="bg-gray-100 hover:bg-gray-200 block py-2 w-full rounded-lg">Logout</button>
                                </form>
                            </div>
                        </div>
                    </nav>
                @endauth

                @guest
                    <nav class="flex gap-2 lg:gap-4">
                        <a href="{{ route('register') }}"
                            class="px-3 lg:px-4 py-2 text-sm lg:text-base text-orange-500 border border-orange-500 rounded-full">Daftar</a>
                        <a href="{{ route('login') }}"
                            class="px-3 lg:px-4 py-2 text-sm lg:text-base bg-orange-500 text-white rounded-full">Login</a>
                    </nav>
                @endguest
            </div>
        </div>
    </header>

    <main class="grow ml-0 lg:ml-72 pb-16">
        {{ $slot }}
    </main>

    {{-- <footer class="h-16 ml-0 lg:ml-72">
        <div class="container h-full">
            <div class="flex items-center justify-center h-full">
                <a href="{{ route('home') }}" class="text-orange-500 hover:underline inline-block">
                    PT. Panorama Alam Bahagia
                </a>
            </div>
        </div>
    </footer> --}}


</body>

</html>
