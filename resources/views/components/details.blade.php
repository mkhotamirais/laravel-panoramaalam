@props([
    'title' => 'title',
    'description' => 'description',
    'detail_title' => 'detail title',
    'detail' => 'detail',
    'bg' => 'bg-white',
])

<div class="{{ $bg }} p-6">
    <h3 class="text-xl font-semibold mb-2 flex items-center gap-2">
        @isset($icon)
            {{ $icon }}
        @endisset
        {{ $title }}
    </h3>
    <div class="text-gray-600">{{ $description }}</div>
    <details class="mt-4">
        <summary class="cursor-pointer text-orange-500 hover:underline">{{ $detail_title }}</summary>
        <div class="text-content">{!! $detail !!}</div>
    </details>
</div>
