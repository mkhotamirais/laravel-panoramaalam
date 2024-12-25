<x-authlayout>
    <div class="py-16">
        <div class="shadow-none sm:shadow-lg p-6 rounded-lg max-w-lg mx-auto">
            <h1 class="font-montserrat text-3xl font-semibold">Login</h1>

            <form action="" class="mt-8">
                {{-- email --}}
                <div class="mb-4">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="input">
                </div>

                {{-- password --}}
                <div class="mb-8">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="input">
                </div>

                {{-- submit --}}
                <button type="submit"
                    class="bg-orange-500 hover:bg-orange-600 transition py-2 px-4 w-full rounded-full text-white">Register</button>
            </form>

            <p class="mt-4">Belum punya akun? <a href="{{ route('register') }}"
                    class="text-orange-500 hover:underline font-medium">Register</a>
            </p>
        </div>
    </div>
</x-authlayout>
