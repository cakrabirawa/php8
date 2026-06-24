<div class="p-6 bg-white rounded-lg shadow" x-data="{
    formData: { id: null, name: '', email: '', password: '', avatar: null },
    errors: {},
    message: '',
    isSubmitting: false,
    isEditing: false, // New state variable to track if we are editing
    avatarPreview: null, // To hold the URL for the avatar preview
    resetForm() { // Helper to reset form state
        this.formData = { id: null, name: '', email: '', password: '', avatar: null };
        this.errors = {};
        this.message = '';
        this.isEditing = false;
        this.avatarPreview = null;
        this.$refs.avatarInput.value = ''; // Reset file input
    },
    startEdit(user) { // Method to populate form for editing
        this.resetForm(); // Clear any previous state
        this.formData.id = user.id;
        this.formData.name = user.name;
        this.formData.email = user.email;
        // Password is not pre-filled for security reasons
        this.isEditing = true;
        this.avatarPreview = user.avatar ? `{{ asset('storage') }}/${user.avatar}` : null;
    },
    handleFileSelect(event) {
        const file = event.target.files[0];
        if (!file) return;

        this.formData.avatar = file;
        this.avatarPreview = URL.createObjectURL(file);
    },
    async submitForm() {
        this.isSubmitting = true;
        this.errors = {};
        this.message = '';

        const payload = new FormData();
        payload.append('name', this.formData.name);
        payload.append('email', this.formData.email);
        if (this.formData.password) {
            payload.append('password', this.formData.password);
        }
        if (this.formData.avatar) {
            payload.append('avatar', this.formData.avatar);
        }

        try {
            let url = this.isEditing ? `{{ url('users') }}/${this.formData.id}` : '{{ route('users.store') }}';
            // For FormData with file uploads, we must use POST and spoof the method for PUT/PATCH
            if (this.isEditing) {
                payload.append('_method', 'PUT');
            }

            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    // 'Content-Type' is not set, browser will set it to 'multipart/form-data'
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: payload
            });
            const result = await response.json();
            if (!response.ok) {
                if (response.status === 422) {
                    this.errors = result.errors;
                } else {
                    this.errors.general = [result.message || 'Terjadi kesalahan yang tidak terduga.'];
                }
            } else {
                this.message = result.message; // Display success message
                this.resetForm(); // Reset form and editing state
                $store.spa.fetchContent('/users', 'User Management - TailAdmin', false); // Refresh the user list
            }
        } catch (error) {
            this.errors.general = [error.message];
            console.error(error);
        } finally {
            this.isSubmitting = false;
        }
    },
    handlePagination(event) {
        const link = event.target.closest('a');
        // Pastikan yang diklik adalah link pagination yang valid dan memiliki href
        if (link && link.href) {
            // Mencegah browser melakukan navigasi standar (full page reload)
            event.preventDefault();
            const url = new URL(link.href);
            // Gunakan fungsi SPA yang sudah ada untuk memuat konten halaman berikutnya
            $store.spa.fetchContent(url.pathname + url.search, 'User Management - TailAdmin', false);
        }
    }
}">
    <h2 class="text-xl font-bold mb-4" x-text="isEditing ? 'Edit User' : 'Tambah User'">User Management</h2>

    <div x-show="message && !errors.general" class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm" x-text="message"></div>
    <div x-show="Object.keys(errors).length > 0" class="bg-red-100 text-red-600 p-3 rounded mb-4 text-sm">
        <span class="font-bold">Error!</span>
        <ul class="list-disc pl-5 mt-1">
            <template x-for="(errorMessages, field) in errors">
                <template x-for="message in errorMessages">
                    <li x-text="message"></li>
                </template>
            </template>
        </ul>
    </div>

    <form @submit.prevent="submitForm" class="mb-6 flex flex-wrap gap-2 items-start justify-between">
        <div class="flex-1 min-w-[150px]">
            <input type="text" x-model="formData.name" placeholder="Nama Lengkap" class="p-2 border rounded text-sm w-full" :class="{ 'border-red-500': errors.name }" required>
            <template x-if="errors.name"><span class="text-red-500 text-xs mt-1" x-text="errors.name[0]"></span></template>
        </div>
        <div class="flex-1 min-w-[150px]">
            <input type="email" x-model="formData.email" placeholder="Email" class="p-2 border rounded text-sm w-full" :class="{ 'border-red-500': errors.email }" required>
            <template x-if="errors.email"><span class="text-red-500 text-xs mt-1" x-text="errors.email[0]"></span></template>
        </div>
        <div class="flex-1 min-w-[150px]">
            <input type="password" x-model="formData.password" placeholder="Password (kosongkan untuk tidak mengubah)" class="p-2 border rounded text-sm w-full" :class="{ 'border-red-500': errors.password }">
            <template x-if="errors.password"><span class="text-red-500 text-xs mt-1" x-text="errors.password[0]"></span></template>
        </div>
        <div class="flex-1 min-w-[150px]">
            <input type="file" @change="handleFileSelect" x-ref="avatarInput" accept="image/*" class="p-1.5 border rounded text-sm w-full file:mr-4 file:py-1 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" :class="{ 'border-red-500': errors.avatar }">
            <template x-if="errors.avatar"><span class="text-red-500 text-xs mt-1" x-text="errors.avatar[0]"></span></template>
        </div>
        <div class="flex-shrink-0">
            <template x-if="avatarPreview">
                <img :src="avatarPreview" alt="Avatar Preview" class="h-10 w-10 rounded-full object-cover">
            </template>
            <template x-if="!avatarPreview">
                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </div>
            </template>
        </div>
        <div class="flex gap-2">
            <button type="submit" :disabled="isSubmitting" class="bg-green-600 text-white px-4 py-2 rounded text-sm hover:bg-green-700 disabled:bg-gray-400">
                <span x-show="!isSubmitting" x-text="isEditing ? 'Update' : 'Tambah'"></span>
                <span x-show="isSubmitting" x-text="isEditing ? 'Memperbarui...' : 'Menambahkan...'"></span>
            </button>
            <button type="button" x-show="isEditing" @click="resetForm()" :disabled="isSubmitting" class="bg-gray-500 text-white px-4 py-2 rounded text-sm hover:bg-gray-600 disabled:bg-gray-400">
                Batal
            </button>
        </div>
    </form>

    <table class="w-full border-collapse text-left text-sm text-gray-500">
        <thead class="bg-gray-50">
            <tr>
                <th class="p-3 font-medium text-gray-900"></th>
                <th class="p-3 font-medium text-gray-900">Nama</th>
                <th class="p-3 font-medium text-gray-900">Email</th>
                <th class="p-3 font-medium text-gray-900">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($users as $user)
            <tr>
                <td class="p-3">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="h-10 w-10 rounded-full object-cover">
                    @else
                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-400" title="No avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        </div>
                    @endif
                </td>
                <td class="p-3 text-gray-900 font-medium">{{ $user->name }}</td>
                <td class="p-3">{{ $user->email }}</td>
                <td class="p-3 flex items-center space-x-2">
                    <button @click="startEdit({{ json_encode($user) }})" class="text-blue-600 hover:underline">Edit</button>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="p-3 text-center text-gray-500">Tidak ada data user.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Container untuk Link Paginasi -->
    <div class="mt-4" @click="handlePagination($event)">
        {{ $users->links() }}
    </div>
</div>
