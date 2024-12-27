<x-authlayout>
    <section class="container py-4">
        <h1 class="title">User List</h1>
        <a href="{{ route('register') }}" class="bg-orange-500 py-2 px-4 text-white text-sm rounded-lg">Tambah User</a>
        <div class="border p-4 rounded-lg mt-4">
            <table class="table-auto w-full">
                <thead class="border-b text-left">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->username }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</x-authlayout>
