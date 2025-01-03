@props(['route' => '', 'cat' => ''])

<a href="{{ route($route, $cat->slug) }}"
    class="absolute top-4 left-4 w-fit text-xs bg-green-500/80 hover:bg-green-600 py-1 px-3 rounded-full text-white">{{ $cat->name ?? 'cat' }}</a>
