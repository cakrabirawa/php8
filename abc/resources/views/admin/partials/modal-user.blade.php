<div x-show="showUserModal" class="fixed inset-0 bg-slate-950/20 backdrop-blur-sm flex items-center justify-center p-4 z-50" x-cloak>
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm p-6" @click.away="showUserModal = false">
        <h3 class="text-base font-bold text-slate-900 mb-4" x-text="userModalMode === 'create' ? 'Tambah Pengguna' : 'Perbarui Pengguna'"></h3>
        <form @submit.prevent="submitUserForm" class="space-y-4">
            <input type="text" x-model="userForm.name" placeholder="Nama Lengkap" required class="w-full rounded-xl border-slate-200 text-sm">
            <input type="email" x-model="userForm.email" placeholder="Alamat Email" required class="w-full rounded-xl border-slate-200 text-sm">
            <select x-model="userForm.role" class="w-full rounded-xl border-slate-200 text-sm">
                <option value="admin">Admin</option><option value="editor">Editor</option><option value="staff">Staff</option>
            </select>
            <input type="password" x-model="userForm.password" placeholder="Kata Sandi" :required="userModalMode === 'create'" class="w-full rounded-xl border-slate-200 text-sm">
            <div class="flex justify-end space-x-2 pt-2">
                <button type="button" @click="showUserModal = false" class="bg-slate-100 px-4 py-2 rounded-xl text-xs font-medium">Batal</button>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-xl text-xs font-medium">Simpan</button>
            </div>
        </form>
    </div>
</div>
