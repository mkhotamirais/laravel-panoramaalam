<x-layout>
    {{-- hero --}}
    <section id="hero"
        class="bg-[url('https://plus.unsplash.com/premium_photo-1719943510748-4b4354fbcf56?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')] bg-center bg-cover">
        <div class="bg-gradient-to-br from-black/20 to-black/80 min-h-[75vh] flex flex-col items-center justify-center">
            <div class="container text-white">
                <div class="space-y-8 max-w-screen-sm leading-relaxed">
                    <div class="font-montserrat">
                        <h1 class="text-4xl lg:text-5xl font-semibold">PANORAMA ALAM</h1>
                        <h3 class="font-semibold text-2xl">Tour and Travel</h3>
                        <div class="h-[3px] bg-orange-500 w-16 mt-2"></div>
                    </div>
                    <p class="deskripsi">Dapatkan kenyamanan <span>Sewa Mobil</span> dan
                        <span>Paket
                            Wisata</span> di Lombok dengan layanan
                        profesional dan ramah dari kami. Jelajahi keindahan Lombok dengan mudah dan nikmati perjalanan
                        yang menyenangkan.
                    </p>
                    <a href="#produk"
                        class="px-8 py-4 rounded-full w-fit bg-orange-500 hover:bg-orange-600 transition flex items-center justify-center text-white font-semibold uppercase">
                        <span>Pesan Sekarang</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    {{-- produk dan layanan --}}
    <section id="produk" class="pt-12 pb-16 scroll-mt-16">
        <div class="container max-w-screen-lg">
            <div class="text-center">
                <h3 class="up-title">Produk dan layanan kami</h3>
                <div class="h-[3px] bg-orange-500 w-16 mx-auto rounded-full my-2"></div>
                <h1 class="title">Pilih Paket yang Kamu Butuhkan</h1>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mt-8">
                <div
                    class="p-8 leading-relaxed border-b overflow-hidden shadow-md hover:shadow-xl transition rounded-lg">
                    <img src="{{ asset('storage/img/storyset-driving-bro.png') }}" alt="" class="scale-90">
                    <h2 class="text-2xl md:text-3xl font-semibold mb-4">Sewa Mobil</h2>
                    <p class="mb-8 text-gray-600">Sewa mobil mulai dari yang kecil hingga yang besar dengan harga
                        terjangkau</p>
                    <a href="{{ route('sewa-mobil') }}"
                        class="font-semibold rounded-full px-5 py-3 bg-orange-500 hover:bg-orange-600 transition text-white">Lebih
                        Lanjut</a>
                </div>
                <div
                    class="p-8 leading-relaxed border-b overflow-hidden shadow-md hover:shadow-xl transition rounded-lg">
                    <img src="{{ asset('storage/img/storyset-Journey-amico.png') }}" alt="" class="scale-90">
                    <h2 class="text-2xl md:text-3xl font-semibold mb-4">Paket Wisata</h2>
                    <p class="mb-8 text-gray-600">Sewa paket wisata dari yang kecil hingga yang besar dengan harga
                        terjangkau</p>
                    <a href="{{ route('paket-wisata') }}"
                        class="font-semibold rounded-full px-5 py-3 bg-orange-500 hover:bg-orange-600 transition text-white">Lebih
                        Lanjut</a>
                </div>

            </div>
        </div>
    </section>
    {{-- tentang kami (tidak dipakai) --}}
    {{-- <section class="py-16 bg-gray-50">
        <div class="container">
            <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-16">
                <div>
                    <h3 class="up-title">Tentang Kami</h3>
                    <div class="h-[3px] bg-orange-500 w-16 rounded-full my-2"></div>
                    <h1 class="title !leading-relaxed">Lebih dekat dengan Panoramaalam</h1>
                    <p class="leading-loose mt-8">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Deserunt amet soluta vitae, inventore
                        exercitationem, rem provident, iure mollitia officiis dignissimos ipsam consectetur. Adipisci
                        necessitatibus nemo eum excepturi placeat quis distinctio esse id, doloremque dolorem pariatur
                        minus, delectus corrupti eveniet maxime.
                    </p>
                    <a href=""
                        class="font-semibold text-orange-500 hover:text-orange-600 transition hover:underline mt-12 flex w-fit items-center gap-2">
                        <div>Lebih Lanjut</div>
                        <x-bi-arrow-right class="w-4 flex" />
                    </a>
                </div>
                <div>
                    <img src="https://picsum.photos/500" alt=""
                        class="object-cover object-center w-full h-full">
                </div>
            </div>
        </div>
    </section> --}}
    {{-- blog --}}
    <section class="py-16 bg-gray-50">
        <div class="container">
            <h3 class="up-title">Baca Artikel</h3>
            <div class="h-[3px] bg-orange-500 w-16 rounded-full my-2"></div>
            <h1 class="title leading-tight">Blog Panoramaalam</h1>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8">
                <div class="rounded-lg overflow-hidden shadow-md hover:shadow-xl transition bg-white">
                    <img src="https://picsum.photos/500/300" alt=""
                        class="w-full h-64 object-center object-cover">
                    <div class="p-6">
                        <h2 class="text-3xl font-semibold mb-2">Judul</h2>
                        <p class="mb-4 text-gray-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa
                            asperiores
                            delectus ab debitis deserunt illum est repellendus nesciunt voluptatem quisquam.
                        </p>
                        <a href="" class="text-orange-500 hover:underline">Lebih Lanjut</a>
                    </div>
                </div>
                <div class="rounded-lg overflow-hidden shadow-md hover:shadow-xl transition bg-white">
                    <img src="https://picsum.photos/500/300" alt=""
                        class="w-full h-64 object-center object-cover">
                    <div class="p-6">
                        <h2 class="text-3xl font-semibold mb-2">Judul</h2>
                        <p class="mb-4 text-gray-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa
                            asperiores
                            delectus ab debitis deserunt illum est repellendus nesciunt voluptatem quisquam.
                        </p>
                        <a href="" class="text-orange-500 hover:underline">Lebih Lanjut</a>
                    </div>
                </div>
                <div class="rounded-lg overflow-hidden shadow-md hover:shadow-xl transition bg-white">
                    <img src="https://picsum.photos/500/300" alt=""
                        class="w-full h-64 object-center object-cover">
                    <div class="p-6">
                        <h2 class="text-3xl font-semibold mb-2">Judul</h2>
                        <p class="mb-4 text-gray-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa
                            asperiores
                            delectus ab debitis deserunt illum est repellendus nesciunt voluptatem quisquam.
                        </p>
                        <a href="" class="text-orange-500 hover:underline">Lebih Lanjut</a>
                    </div>
                </div>
            </div>
            <div class="flex items-center mt-8">
                <a href="{{ route('blog-wisata') }}"
                    class="font-semibold rounded-full px-5 py-3 bg-orange-500 hover:bg-orange-600 transition text-white">Lihat
                    Semua Blog</a>
            </div>
        </div>
    </section>
    {{-- contact (tidak dipakai) --}}
    {{-- <section class="bg-[url('https://picsum.photos/1440/720')] bg-conver bg-center min-h-[30vh] bg-fixed">
        <div class="bg-gradient-to-t from-black/50 to-black/70 min-h-[30vh] flex flex-col items-center justify-center">
            <div class="container text-white py-12">
                <div class="flex flex-col gap-4 items-center justify-center text-center">
                    <h1 class="title">Mau sewa mobil atau pilih paket liburan?</h1>
                    <p class="text-lg">Hubungi kami untuk reservasi dan info lebih lengkap.</p>
                    <a href=""
                        class="group border-2 border-orange-200 rounded-xl p-4 flex items-center gap-4 text-2xl hover:ring-2 hover:ring-orange-500 transition">
                        <img src="https://raw.githubusercontent.com/grommet/grommet-icons/master/public/img/whatsapp.svg"
                            alt="" class="size-12">
                        <div class="text-white group-hover:text-orange-500 transition">Hubungi Kami</div>
                    </a>
                </div>
            </div>
        </div>
    </section> --}}
    {{-- contact --}}
    <section class="min-h-[30vh]">
        <div class="container py-16">
            <div class="flex flex-col gap-4 items-center justify-center text-center">
                <h1 class="text-3xl lg:text-4xl font-semibold">Mau sewa mobil atau pilih paket liburan?</h1>
                <p class="text-lg">Hubungi kami untuk reservasi dan info lebih lengkap.</p>
                <a href=""
                    class="group border-2 border-orange-200 rounded-xl p-4 flex items-center gap-4 hover:ring-2 hover:ring-orange-500 transition">
                    <img src="https://raw.githubusercontent.com/grommet/grommet-icons/master/public/img/whatsapp.svg"
                        alt="" class="size-8">
                    <div class="group-hover:text-orange-500 transition font-semibold text-lg">Hubungi Kami</div>
                </a>
            </div>
        </div>
    </section>
    {{-- galery --}}
    {{-- <section class="py-16">
        <div class="container">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <img src="https://picsum.photos/500" alt="" class="object-cover object-center w-full">
                <img src="https://picsum.photos/500" alt="" class="object-cover object-center w-full">
                <img src="https://picsum.photos/500" alt="" class="object-cover object-center w-full">
            </div>
        </div>
    </section> --}}
</x-layout>
