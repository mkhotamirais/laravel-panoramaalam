<x-authlayout>
    <div class="py-16 -translate-x-36">
        <div class="shadow-none sm:shadow-lg p-6 rounded-lg max-w-lg mx-auto">
            <h1 class="font-montserrat text-3xl font-semibold">Register</h1>

            <form action="{{ route('register') }}" method="POST" class="mt-8">
                @csrf

                {{-- username --}}
                <div class="mb-4">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="{{ old('username') }}"
                        class="input @error('username') !ring-red-500 @enderror">
                    @error('username')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- email --}}
                <div class="mb-4">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="{{ old('email') }}"
                        class="input @error('email') !ring-red-500 @enderror">
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- password --}}
                <div class="mb-4">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password"
                        class="input @error('password') !ring-red-500 @enderror">
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- password confirmation --}}
                <div class="mb-8">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="input @error('password') !ring-red-500 @enderror">
                </div>

                {{-- submit --}}
                <button type="submit"
                    class="bg-orange-500 hover:bg-orange-600 transition py-2 px-4 w-full rounded-full text-white">Register</button>
            </form>

            <p class="mt-4">Sudah punya akun? <a href="{{ route('login') }}"
                    class="text-orange-500 hover:underline font-medium">Login</a>
            </p>
        </div>
    </div>
</x-authlayout>
