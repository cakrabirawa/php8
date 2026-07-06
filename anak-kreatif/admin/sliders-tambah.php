<?php
require_once '../config/database.php';

if (!isset($_SESSION['login_admin'])) {
  header("Location: " . ADMIN_URL . "login");
  exit;
}
?>
<?php include 'header.php'; ?>

<div class="w-full">
  <div class="mb-6">
    <h1 class="text-2xl font-black text-gray-800 dark:text-zinc-100">➕ Tambah Gambar Slider</h1>
    <p class="text-gray-500 mt-1 dark:text-zinc-400">Tambah gambar latar belakang transisi pada beranda depan.</p>
  </div>

  <div class="bg-white p-6 rounded-xl shadow-sm border dark:bg-zinc-900 dark:border-zinc-700">
    <form action="<?= ADMIN_URL ?>sliders-aksi" method="POST" enctype="multipart/form-data" class="space-y-4 ajax-form" data-redirect-url="<?= ADMIN_URL ?>sliders">
      <?= csrf_token_input(); ?>
      <input type="hidden" name="action_type" value="insert">
      <div>
        <label class="block font-semibold mb-1 dark:text-zinc-200">Nama/Label Gambar</label>
        <input type="text" name="judul_slider" placeholder="Contoh: Banner Promo Buku" required class="w-full p-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>
      <div class="bg-gray-50 p-4 rounded-lg border border-dashed space-y-4 dark:bg-zinc-800/50 dark:border-zinc-700">
        <div>
          <label class="block text-xs font-bold text-gray-400 mb-1 dark:text-zinc-400">Opsi 1: Upload Berkas File</label>
          <input type="file" name="gambar_upload" accept="image/*" class="w-full p-1 border bg-white rounded text-sm dark:bg-zinc-700 dark:border-zinc-600">
        </div>
        <div class="text-center text-xs font-black text-gray-300">ATAU</div>
        <div>
          <label class="block text-xs font-bold text-gray-400 mb-1 dark:text-zinc-400">Opsi 2: Tautan URL Gambar</label>
          <input type="url" name="gambar_url" placeholder="https://..." class="w-full p-2 border bg-white rounded text-sm dark:bg-zinc-700 dark:border-zinc-600">
        </div>
      </div>

      <div class="flex items-center gap-2 pt-1">
        <input type="checkbox" name="is_active" id="is_active" value="1" checked class="w-4 h-4 text-amber-500 border-gray-300 rounded focus:ring-amber-400">
        <label for="is_active" class="font-semibold text-gray-700 select-none cursor-pointer dark:text-zinc-300">Langsung Aktifkan di Halaman Utama</label>
      </div>

      <div class="flex gap-2">
        <button type="submit" class="bg-amber-500 text-white px-4 py-2 rounded font-bold hover:bg-amber-600">Terbitkan Slider</button>
        <a href="<?= ADMIN_URL ?>sliders" class="spa-trigger bg-gray-100 px-4 py-2 rounded font-bold text-gray-700 hover:bg-gray-200 dark:bg-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-600">Batal</a>
      </div>
    </form>
  </div>
</div>

<?php include 'footer.php'; ?>