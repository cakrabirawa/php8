<?php $__env->startSection('title', 'Beranda - Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Elemen ini bertugas mengirimkan judul baru ke Javascript saat AJAX sukses -->
    <input type="hidden" id="ajax-title-bridge" value="Beranda - Dashboard">

    <div class="space-y-6">
        <h1 class="text-2xl font-bold text-gray-900">Selamat Datang di Beranda</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="text-sm text-gray-500 font-medium">Total Produk</div>
                <div class="text-3xl font-bold text-slate-800 mt-2">1,240 Item</div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="text-sm text-gray-500 font-medium">Pengguna Aktif</div>
                <div class="text-3xl font-bold text-green-600 mt-2">89 User</div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\projects\php8\dashboard-app\resources\views/beranda.blade.php ENDPATH**/ ?>