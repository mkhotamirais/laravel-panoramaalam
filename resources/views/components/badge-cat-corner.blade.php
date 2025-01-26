@props(['route' => '', 'cat' => ''])

<a href="{{ route($route, $cat->slug) }}"
    class="absolute top-2 right-2 ml-2 lg:top-4 lg:right-4 lg:ml-4 text-[0.70rem] capitalize lg:text-xs bg-orange-500/60 hover:bg-orange-600 py-1 px-3 rounded-full text-white">{{ $cat->name ?? 'cat' }}</a>
