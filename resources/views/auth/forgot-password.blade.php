<x-layout>
    <section class="w-1/2 mx-auto py-8">
        <h1 class="title">Lupa Password</h1>
        <p class="mb-4">
            Kamu lupa password? Tidak masalah. Kami akan mengirimkan link reset
            password ke alamat email kamu.
        </p>

        <!-- Errors Messages -->
        {{-- <SessionMsg :msg="form.errors.error" type="error" />
        <SessionMsg :msg="status" /> --}}

        <form action="{{ route('password.email') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" placeholder="example@email.com"
                    value="{{ old('email') }}" class="input @error('email') !ring-red-500 @enderror">
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn">
                Kirim link reset password
            </button>
        </form>
    </section>
</x-layout>
