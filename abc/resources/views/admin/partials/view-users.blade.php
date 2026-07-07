<div x-show="activePage === 'admin.users'" x-cloak>
    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-bold text-slate-900">Daftar Pengguna Aplikasi</h2>
            <button @click="openUserModal('create')" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold px-4 py-2 rounded-xl shadow-sm transition">+ Tambah User</button>
        </div>
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 font-medium">
                <tr><th class="p-4">Nama</th><th class="p-4">Email</th><th class="p-4">Role</th><th class="p-4 text-right">Aksi</th></tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <template x-for="user in users" :key="user.id">
                    <tr class="hover:bg-slate-50/80">
                        <td class="p-4 font-medium" x-text="user.name"></td>
                        <td class="p-4 text-slate-500" x-text="user.email"></td>
                        <td class="p-4 capitalize" x-text="user.role"></td>
                        <td class="p-4 text-right space-x-2">
                            <button @click="openUserModal('edit', user)" class="text-indigo-600 hover:underline">Edit</button>
                            <button @click="deleteUser(user.id)" class="text-red-600 hover:underline">Hapus</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</div>
