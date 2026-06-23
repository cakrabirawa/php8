<div class="p-6 bg-white rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">User Management</h2>

    <!-- Form Tambah User Cepat -->
    <form action="{{ route('users.store') }}" method="POST" class="mb-6 flex gap-2">
        @csrf
        <input type="text" name="name" placeholder="Nama Lengkap" class="p-2 border rounded text-sm w-full" required>
        <input type="email" name="email" placeholder="Email" class="p-2 border rounded text-sm w-full" required>
        <input type="password" name="password" placeholder="Password" class="p-2 border rounded text-sm w-full" required>
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded text-sm hover:bg-green-700">Tambah</button>
    </form>

    <!-- Tabel List User -->
    <table class="w-full border-collapse text-left text-sm text-gray-500">
        <thead class="bg-gray-50">
            <tr>
                <th class="p-3 font-medium text-gray-900">Nama</th>
                <th class="p-3 font-medium text-gray-900">Email</th>
                <th class="p-3 font-medium text-gray-900">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($users as $user)
            <tr>
                <td class="p-3 text-gray-900 font-medium">{{ $user->name }}</td>
                <td class="p-3">{{ $user->email }}</td>
                <td class="p-3">
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
