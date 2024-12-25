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

<body class="min-h-screen flex flex-col font-poppins">
    <header class="h-16 border-b sticky top-0 bg-white z-50">
        <div class="container h-full">
            <div class="flex justify-between items-center h-full">
                <x-logo />
                <nav class="flex gap-4">
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 text-orange-500 border border-orange-500 rounded-xl">Register</a>
                    <a href="{{ route('login') }}" class="px-4 py-2 bg-orange-500 text-white rounded-xl">Login</a>
                </nav>
            </div>
        </div>
    </header>

    <main class="grow">
        {{ $slot }}
    </main>

    <footer class="h-16">
        <div class="container h-full">
            <div class="flex items-center justify-center h-full">
                <a href="{{ route('home') }}" class="text-orange-500 hover:underline inline-block">
                    PT. Panorama Alam Bahagia
                </a>
            </div>
        </div>
    </footer>
</body>

</html>
