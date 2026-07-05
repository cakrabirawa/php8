<?php
require_once '../config/database.php';

if (!isset($_SESSION['login_admin'])) {
  header("Location: " . ADMIN_URL . "login");
  exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$res = mysqli_query($conn, "SELECT * FROM kelas_menulis WHERE id=$id");
if (mysqli_num_rows($res) === 0) {
  header("Location: " . ADMIN_URL . "kelas");
  exit;
}
$kelas = mysqli_fetch_assoc($res);
?>
<?php include 'header.php'; ?>

<div class="w-full">
  <div class="mb-6">
    <h1 class="text-2xl font-black text-gray-800 dark:text-zinc-100">📝 Edit Program Kelas Menulis</h1>
    <p class="text-gray-500 mt-1 dark:text-zinc-400">Mengubah detail kelas dan materi pembelajaran.</p>
  </div>

  <div class="bg-white p-8 rounded-2xl shadow-sm border w-full dark:bg-zinc-900 dark:border-zinc-700">
    <form action="<?= ADMIN_URL ?>kelas-aksi" method="POST" enctype="multipart/form-data" class="space-y-4 text-sm ajax-form" data-redirect-url="<?= ADMIN_URL ?>kelas">
      <?= csrf_token_input(); ?>
      <input type="hidden" name="action_type" value="update">
      <input type="hidden" name="id" value="<?= $kelas['id']; ?>">
      <input type="hidden" name="gambar_lama" value="<?= $kelas['gambar']; ?>">

      <div><label class="block font-medium mb-1 dark:text-zinc-200">Nama Program Kelas</label>
        <input type="text" name="nama_kelas" value="<?= htmlspecialchars($kelas['nama_kelas']); ?>" required class="w-full p-2.5 border rounded-lg dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>

      <div><label class="block font-medium mb-1 dark:text-zinc-200">Mentor Pengajar</label>
        <input type="text" name="mentor" value="<?= htmlspecialchars($kelas['mentor']); ?>" required class="w-full p-2.5 border rounded-lg dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div><label class="block font-medium mb-1 dark:text-zinc-200">Biaya Kelas (Rp)</label>
          <input type="number" name="harga_kelas" value="<?= $kelas['harga_kelas']; ?>" required class="w-full p-2.5 border rounded-lg dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
        </div>
        <div><label class="block font-medium mb-1 dark:text-zinc-200">Kuota Maksimal</label>
          <input type="number" name="kuota" value="<?= $kelas['kuota']; ?>" required class="w-full p-2.5 border rounded-lg dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
        </div>
      </div>

      <div><label class="block font-medium mb-1 dark:text-zinc-200">Jadwal Kelas</label>
        <input type="text" name="jadwal" value="<?= htmlspecialchars($kelas['jadwal']); ?>" required class="w-full p-2.5 border rounded-lg dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>

      <div class="bg-gray-50 p-3 rounded-lg border space-y-3 dark:bg-zinc-800/50 dark:border-zinc-700">
        <div><label class="block text-xs font-semibold text-gray-500 mb-1 dark:text-zinc-400">Opsi 1: Ganti File Gambar Baru</label>
          <input type="file" name="gambar_upload" accept="image/*" class="w-full p-1 border bg-white rounded-md text-xs dark:bg-zinc-700 dark:border-zinc-600">
        </div>
        <div class="text-center text-xs text-gray-400 font-bold">ATAU</div>
        <div><label class="block text-xs font-semibold text-gray-500 mb-1 dark:text-zinc-400">Opsi 2: Ganti Tautan URL Gambar</label>
          <input type="url" name="gambar_url" value="<?= filter_var($kelas['gambar'], FILTER_VALIDATE_URL) ? htmlspecialchars($kelas['gambar']) : ''; ?>" class="w-full p-2 border bg-white rounded-md text-xs dark:bg-zinc-700 dark:border-zinc-600">
        </div>
      </div>

      <div><label class="block font-medium mb-1 dark:text-zinc-200">Detail Materi Pembelajaran</label>
        <textarea name="deskripsi_kelas" required class="w-full p-2.5 border rounded-lg h-28 dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100"><?= htmlspecialchars($kelas['deskripsi_kelas']); ?></textarea>
      </div>

      <div class="flex gap-3 pt-2">
        <button type="submit" class="flex-grow bg-teal-500 text-white font-bold py-2.5 rounded-lg hover:bg-teal-600">Simpan Perubahan</button>
        <a href="<?= ADMIN_URL ?>kelas" class="bg-gray-200 text-gray-700 font-bold py-2.5 px-5 rounded-lg hover:bg-gray-300 dark:bg-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-600">Batal</a>
      </div>
    </form>
  </div>
</div>
<?php include 'footer.php'; ?>