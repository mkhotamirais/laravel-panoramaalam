<x-authlayout>
    <div class="container py-4">

        <h1 class="title">Halo, {{ auth()->user()->username ?? '' }}</h1>
        <p class="text-gray-600">Selamat datang di Dashboard Panorama Alam</p>

        {{-- cards --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mt-8">
            <x-dash-card title="Blog" total="{{ $blogs->count() }}" :links="$links['blog']" />
            <x-dash-card title="Destination Blog" total="{{ $destinationblogs->count() }}" :links="$links['destinationblog']" />
            <x-dash-card title="Car Rental" total="{{ $carrentals->count() }}" :links="$links['carrental']" />
            <x-dash-card title="Tour Package" total="{{ $tourpackages->count() }}" :links="$links['tourpackage']" />
        </div>
    </div>
</x-authlayout>
