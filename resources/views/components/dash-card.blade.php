@props(['title' => 'title', 'total' => 10, 'links' => []])

<div class="shadow hover:shadow-lg transition rounded-lg p-6">
    <h2 class="text-2xl font-semibold">{{ $title }} ({{ $total }})</h2>
    <div class="mt-4 flex flex-col gap-2">
        @foreach ($links as $link)
            <a href="{{ route($link['href']) }}"
                class="text-orange-500 hover:text-orange-600 w-fit">{{ $link['label'] }}</a>
        @endforeach
    </div>
</div>
