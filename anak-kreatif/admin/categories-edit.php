<?php
require_once '../config/database.php';
if (!isset($_SESSION['login_admin'])) {
  header("Location: " . ADMIN_URL . "login");
  exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
  header('Location: ' . ADMIN_URL . 'categories');
  exit;
}

$res = mysqli_query($conn, "SELECT * FROM kategori_produk WHERE id=$id");
if (mysqli_num_rows($res) === 0) {
  header('Location: ' . ADMIN_URL . 'categories');
  exit;
}
$cat = mysqli_fetch_assoc($res);
?>
<?php include 'header.php'; ?>

<div class="w-full">
  <div class="mb-6">
    <h1 class="text-2xl font-black text-gray-800 dark:text-zinc-100">✏️ Ubah Kategori</h1>
    <p class="text-gray-500 mt-1 dark:text-zinc-400">Mengubah detail data kategori.</p>
  </div>

  <div class="bg-white p-6 rounded-xl shadow-sm border dark:bg-zinc-900 dark:border-zinc-700">
    <form action="<?= ADMIN_URL ?>categories-aksi" method="POST" class="space-y-4 ajax-form" data-redirect-url="<?= ADMIN_URL ?>categories">
      <?= csrf_token_input(); ?>
      <input type="hidden" name="action_type" value="update">
      <input type="hidden" name="id" value="<?= $cat['id']; ?>">
      <div>
        <label class="block font-semibold mb-1 dark:text-zinc-200">Nama Kategori</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($cat['nama']); ?>" required class="w-full p-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>
      <div class="flex items-center gap-2 pt-1">
        <input type="checkbox" name="is_active" id="is_active" value="1" <?= (int)$cat['is_active'] === 1 ? 'checked' : ''; ?> class="w-4 h-4 text-green-500 border-gray-300 rounded focus:ring-green-400">
        <label for="is_active" class="font-semibold text-gray-700 select-none cursor-pointer dark:text-zinc-300">Aktifkan</label>
      </div>
      <div class="flex gap-2">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Perubahan</button>
        <a href="<?= ADMIN_URL ?>categories" class="spa-trigger bg-gray-100 px-4 py-2 rounded dark:bg-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-600">Batal</a>
      </div>
    </form>
  </div>
</div>
<?php include 'footer.php'; ?>