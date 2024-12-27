<x-authlayout>
    <div class="container">

        <h1>Halo, {{ auth()->user()->username }}</h1>

        <div class="flex flex-col gap-2">
            <a href="{{ route('blogs.index') }}">Blog Index</a>
        </div>
    </div>
</x-authlayout>
