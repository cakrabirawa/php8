<div x-show="activePage === 'admin.access'" x-cloak>
    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
        <h2 class="text-lg font-bold text-slate-900 mb-4">Matriks Otorisasi Hak Akses</h2>
        <select x-model="selectedRole" @change="fetchPermissions()" class="rounded-xl border-slate-200 text-sm mb-6 w-64">
            <option value="admin">Administrator</option>
            <option value="editor">Editor</option>
            <option value="staff">Staff</option>
        </select>
        <div class="grid grid-cols-2 gap-3 border-t border-slate-100 pt-4">
            <template x-for="m in allAvailableMenus" :key="m.id">
                <label class="flex items-center space-x-3 p-3 bg-slate-50 rounded-xl border border-slate-200 hover:bg-slate-100 cursor-pointer">
                    <input type="checkbox" :value="m.id" x-model="allowedMenuIds" class="rounded text-indigo-600">
                    <span class="text-sm font-medium text-slate-700" x-text="m.name"></span>
                </label>
            </template>
        </div>
        <div class="mt-6 flex justify-end">
            <button @click="savePermissions()" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold px-5 py-2.5 rounded-xl shadow-sm">Simpan Matriks</button>
        </div>
    </div>
</div>
