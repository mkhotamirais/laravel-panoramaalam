<x-authlayout>
    <div class="container">

        <h1>Halo, {{ auth()->user()->username ?? '' }}</h1>

        <p>halo</p>
    </div>
</x-authlayout>
