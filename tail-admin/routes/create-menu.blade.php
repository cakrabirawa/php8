<div class="bg-white p-6 rounded-xl shadow-md border border-gray-200">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Buat Menu Baru</h2>
    <p class="text-gray-600 mb-6">Gunakan form ini untuk menambahkan item menu baru ke sidebar.</p>

    <form id="create-menu-form" @submit.prevent="submitMenuForm">
        @csrf
        <div class="space-y-4">
            <!-- Menu ID -->
            <div>
                <label for="menu_id" class="block text-sm font-medium text-gray-700">Menu ID</label>
                <input type="text" name="id" id="menu_id" required
                    class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    placeholder="Contoh: new-products">
                <p class="mt-1 text-xs text-gray-500">Pengenal unik tanpa spasi (gunakan tanda hubung). Contoh: 'active-orders'.</p>
            </div>

            <!-- Menu Label -->
            <div>
                <label for="menu_label" class="block text-sm font-medium text-gray-700">Label Menu</label>
                <input type="text" name="label" id="menu_label" required
                    class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    placeholder="Contoh: Produk Baru">
                <p class="mt-1 text-xs text-gray-500">Teks yang akan ditampilkan di sidebar.</p>
            </div>

            <!-- Page Name -->
            <div>
                <label for="page_name" class="block text-sm font-medium text-gray-700">Nama Halaman (Page Name)</label>
                <input type="text" name="pageName" id="page_name" required
                    class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    placeholder="Contoh: new-products">
                <p class="mt-1 text-xs text-gray-500">Nama file partial view yang akan dimuat. Biasanya sama dengan ID.</p>
            </div>

            <!-- SVG Icon -->
            <div>
                <label for="menu_icon" class="block text-sm font-medium text-gray-700">Ikon SVG</label>
                <textarea name="icon" id="menu_icon" rows="4" required
                    class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm font-mono"
                    placeholder='<svg class="w-5 h-5" ...></svg>'></textarea>
                <p class="mt-1 text-xs text-gray-500">Salin dan tempel kode SVG lengkap di sini.</p>
            </div>
        </div>

        <!-- Tombol Submit -->
        <div class="mt-6">
            <button type="submit"
                class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Simpan Menu
            </button>
        </div>
    </form>

    <!-- Notifikasi -->
    <div id="menu-notification" class="mt-4"></div>
</div>

<script>
    function submitMenuForm() {
        const form = document.getElementById('create-menu-form');
        const notification = document.getElementById('menu-notification');
        const formData = new FormData(form);

        notification.innerHTML = '';

        fetch('/admin/menu', {
            method: 'POST',
            body: new URLSearchParams(formData),
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/x-www-form-urlencoded',
            },
        })
        .then(response => response.json())
        .then(data => {
            const alertClass = data.success ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
            notification.innerHTML = `<div class="${alertClass} p-4 rounded-md">${data.message}</div>`;
            if (data.success) form.reset();
        })
        .catch(error => {
            notification.innerHTML = `<div class="bg-red-100 text-red-800 p-4 rounded-md">Terjadi kesalahan: ${error.message}</div>`;
        });
    }
</script>