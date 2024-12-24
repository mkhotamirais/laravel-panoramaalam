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

<body>
    <header class="h-16 border-b sticky top-0">
        <div class="container h-full">
            <div class="flex justify-between items-center h-full">
                <a href="{{ route('home') }}" class="font-playfaird text-lg">PANORAMAALAM</a>
                <nav class="flex gap-4">
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                </nav>
            </div>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>
</body>

</html>
