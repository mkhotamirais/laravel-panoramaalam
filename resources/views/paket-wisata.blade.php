<x-layout>
    {{-- hero --}}
    <section
        class="min-h-[40vh] bg-[url('https://plus.unsplash.com/premium_photo-1719943510748-4b4354fbcf56?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')] bg-center bg-cover">
        <div class="bg-gradient-to-t from-black/40 to-black/60 min-h-[40vh] flex flex-col items-center justify-center">
            <div class="container text-white">
                <div class="space-y-8 max-w-screen-sm leading-relaxed">
                    <h1 class="text-4xl lg:text-5xl font-semibold">Blog Wisata</h1>
                    {{-- <div class="h-1 bg-orange-500 w-32"></div> --}}

                    {{-- search form --}}
                    <form>
                        {{-- @if (request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
        
                        @if (request('author'))
                            <input type="hidden" name="author" value="{{ request('author') }}">
                        @endif --}}

                        <div class="items-center mx-auto max-w-screen-sm flex sm:space-y-0">
                            <div class="relative w-full">
                                <label for="search"
                                    class="hidden mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Search</label>
                                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                    <x-bi-search class="w-5 h-5 text-gray-500 dark:text-gray-400"></x-bi-search>
                                </div>
                                <input name="search" autocomplete="off"
                                    class="block p-3 pl-10 w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-l-lg focus:ring-primary-500 focus:border-primary-500"
                                    placeholder="Search blogs" type="text" id="search">
                            </div>
                            <div>
                                <button type="submit"
                                    class="rounded-l-none py-3 px-5 text-sm font-medium text-center text-white border cursor-pointer bg-orange-500 transition hover:bg-orange-600  rounded-r-lg focus:ring-4 focus:ring-orange-300">
                                    Cari
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    {{-- paket wisata list --}}
    <section class="py-16">
        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                    <img src="https://picsum.photos/500" alt="" class="object-cover object-center w-full h-64">
                    <div class="p-6 space-y-4">
                        <h2 class="text-3xl font-semibold mb-2">Judul</h2>
                        <h1>Harga</h1>
                        <p>Tags</p>
                        <a href="" class="inline-block rounded-full bg-orange-500 py-3 px-5 text-white">Pesan</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
