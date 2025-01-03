@props(['cats' => [], 'route' => 'category-blogs', 'current' => null])

<div class="mt-2">
    @foreach ($cats as $cat)
        <a href="{{ route($route, $cat->slug) }}"
            class="border backdrop-blur border-gray-700 rounded-lg hover:border-orange-500 text-xs py-1 px-3 mr-2 {{ $cat->slug == $current ? 'bg-orange-500 text-white' : '' }}">{{ $cat->name }}</a>
    @endforeach
</div>
