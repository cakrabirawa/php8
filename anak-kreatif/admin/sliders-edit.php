<?php
require_once '../config/database.php';

if (!isset($_SESSION['login_admin'])) {
  header("Location: " . ADMIN_URL . "login");
  exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$res = mysqli_query($conn, "SELECT * FROM sliders WHERE id=$id");
if (mysqli_num_rows($res) === 0) {
  header("Location: " . ADMIN_URL . "sliders");
  exit;
}
$slider = mysqli_fetch_assoc($res);
?>
<?php include 'header.php'; ?>

<div class="w-full">
  <div class="mb-6">
    <h1 class="text-2xl font-black text-gray-800 dark:text-zinc-100">📝 Edit Gambar Latar Slider</h1>
    <p class="text-gray-500 mt-1 dark:text-zinc-400">Mengubah gambar transisi pada beranda.</p>
  </div>

  <div class="bg-white p-6 rounded-2xl shadow-sm border w-full dark:bg-zinc-900 dark:border-zinc-700">

    <form action="<?= ADMIN_URL ?>sliders-aksi" method="POST" enctype="multipart/form-data" class="space-y-4 ajax-form" data-redirect-url="<?= ADMIN_URL ?>sliders">
      <input type="hidden" name="action_type" value="update">
      <?= csrf_token_input(); ?>
      <input type="hidden" name="id" value="<?= $slider['id']; ?>">
      <input type="hidden" name="gambar_lama" value="<?= $slider['gambar']; ?>">

      <div>
        <label class="block font-medium mb-1 dark:text-zinc-200">Nama/Label Gambar</label>
        <input type="text" name="judul_slider" value="<?= htmlspecialchars($slider['judul_slider']); ?>" required class="w-full p-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>

      <div class="bg-gray-50 p-3 rounded-lg border space-y-3 dark:bg-zinc-800/50 dark:border-zinc-700">
        <div>
          <label class="block text-[10px] font-bold text-gray-400 mb-1 dark:text-zinc-400">Opsi 1: Ganti File Gambar Baru</label>
          <input type="file" name="gambar_upload" accept="image/*" class="w-full p-1 border bg-white rounded text-[10px] dark:bg-zinc-700 dark:border-zinc-600">
        </div>
        <div class="text-center text-[10px] font-black text-gray-300">ATAU</div>
        <div>
          <label class="block text-[10px] font-bold text-gray-400 mb-1 dark:text-zinc-400">Opsi 2: Ganti Tautan URL Gambar</label>
          <input type="url" name="gambar_url" value="<?= filter_var($slider['gambar'], FILTER_VALIDATE_URL) ? htmlspecialchars($slider['gambar']) : ''; ?>" class="w-full p-2 border bg-white rounded text-[10px] dark:bg-zinc-700 dark:border-zinc-600">
        </div>
      </div>

      <!-- FIELD EDIT STATUS AKTIF -->
      <div class="flex items-center gap-2">
        <input type="checkbox" name="is_active" id="is_active" value="1" <?= (int)$slider['is_active'] === 1 ? 'checked' : '' ?> class="w-4 h-4 text-amber-500 border-gray-300 rounded focus:ring-amber-400">
        <label for="is_active" class="font-semibold text-gray-700 select-none cursor-pointer dark:text-zinc-300">Tampilkan gambar ini di halaman utama</label>
      </div>

      <div class="flex gap-2 pt-2 font-semibold">
        <button type="submit" class="flex-grow bg-amber-500 text-white py-2 rounded-md hover:bg-amber-600">Simpan Perubahan</button>
        <a href="<?= ADMIN_URL ?>sliders" class="bg-gray-200 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-300 text-center dark:bg-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-600">Batal</a>
      </div>
    </form>
  </div>
</div>
<?php include 'footer.php'; ?>