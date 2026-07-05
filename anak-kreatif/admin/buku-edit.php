<?php
require_once '../config/database.php';
if (!isset($_SESSION['login_admin'])) {
  header("Location: " . ADMIN_URL . "login");
  exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$res = mysqli_query($conn, "SELECT * FROM produk_buku WHERE id=$id");
if (mysqli_num_rows($res) === 0) {
  header("Location: " . ADMIN_URL . "buku");
  exit;
}
$buku = mysqli_fetch_assoc($res);

// ambil kategori untuk select
$kategori_res = mysqli_query($conn, "SELECT id, nama FROM kategori_produk WHERE is_active = 1 ORDER BY nama");
// build kategori list
$kategori_list = [];
if ($kategori_res) {
  while ($kr = mysqli_fetch_assoc($kategori_res)) {
    $kategori_list[(int)$kr['id']] = $kr['nama'];
  }
}
// ambil klasifikasi untuk select
$klasifikasi_res = mysqli_query($conn, "SELECT id, nama FROM klasifikasi_produk WHERE is_active = 1 ORDER BY id");
$klasifikasi_list = [];
if ($klasifikasi_res) {
  while ($kl = mysqli_fetch_assoc($klasifikasi_res)) {
    $klasifikasi_list[(int)$kl['id']] = $kl['nama'];
  }
}
?>
<?php include 'header.php'; ?>

<div class="w-full">
  <div class="mb-6">
    <h1 class="text-2xl font-black text-gray-800 dark:text-zinc-100">📝 Edit Buku Cerita</h1>
    <p class="text-gray-500 mt-1 dark:text-zinc-400">Mengubah detail data buku.</p>
  </div>

  <div class="bg-white p-8 rounded-2xl shadow-sm border w-full dark:bg-zinc-900 dark:border-zinc-700">
    <form action="<?= ADMIN_URL ?>buku-aksi" method="POST" enctype="multipart/form-data" class="space-y-4 text-sm ajax-form" data-redirect-url="<?= ADMIN_URL ?>buku">
      <?= csrf_token_input(); ?>
      <input type="hidden" name="id" value="<?= $buku['id']; ?>">
      <input type="hidden" name="gambar_lama" value="<?= $buku['gambar']; ?>">

      <div><label class="block font-medium mb-1 dark:text-zinc-200">Judul Buku</label>
        <input type="text" name="judul" value="<?= htmlspecialchars($buku['judul']); ?>" required class="w-full p-2.5 border rounded-lg dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>

      <div><label class="block font-medium mb-1 dark:text-zinc-200">Nama Penulis</label>
        <input type="text" name="penulis" value="<?= htmlspecialchars($buku['penulis']); ?>" required class="w-full p-2.5 border rounded-lg dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div><label class="block font-medium mb-1 dark:text-zinc-200">Harga (Rp)</label>
          <input type="number" name="harga" value="<?= $buku['harga']; ?>" required class="w-full p-2.5 border rounded-lg dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
        </div>
        <div><label class="block font-medium mb-1 dark:text-zinc-200">Stok</label>
          <input type="number" name="stok" value="<?= $buku['stok']; ?>" required class="w-full p-2.5 border rounded-lg dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
        </div>
      </div>

      <div class="bg-gray-50 p-3 rounded-lg border space-y-3 dark:bg-zinc-800/50 dark:border-zinc-700">
        <div><label class="block text-xs font-semibold text-gray-500 mb-1 dark:text-zinc-400">Opsi 1: Ganti File Gambar Baru</label>
          <input type="file" name="gambar_upload" accept="image/*" class="w-full p-1 border bg-white rounded-md text-xs dark:bg-zinc-700 dark:border-zinc-600">
        </div>
        <div class="text-center text-xs text-gray-400 font-bold">ATAU</div>
        <div><label class="block text-xs font-semibold text-gray-500 mb-1 dark:text-zinc-400">Opsi 2: Ganti Tautan URL Gambar</label>
          <input type="url" name="gambar_url" value="<?= filter_var($buku['gambar'], FILTER_VALIDATE_URL) ? htmlspecialchars($buku['gambar']) : ''; ?>" class="w-full p-2 border bg-white rounded-md text-xs dark:bg-zinc-700 dark:border-zinc-600">
        </div>
      </div>

      <div><label class="block font-medium mb-1 dark:text-zinc-200">Sinopsis</label>
        <textarea name="deskripsi" required class="w-full p-2.5 border rounded-lg h-28 dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100"><?= htmlspecialchars($buku['deskripsi']); ?></textarea>
      </div>
      <div>
        <label class="block font-medium mb-1 dark:text-zinc-200">Kategori</label>
        <select name="kategori_id" class="w-full p-2.5 border rounded-lg dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
          <option value="">-- Tidak ada --</option>
          <?php if (!empty($kategori_list)) : foreach ($kategori_list as $kid => $knama) : ?>
              <option value="<?= $kid; ?>" <?= ((int)$buku['kategori_id'] === $kid) ? 'selected' : ''; ?>><?= htmlspecialchars($knama); ?></option>
          <?php endforeach;
          endif; ?>
        </select>

        <label class="block font-medium mt-2 mb-1 dark:text-zinc-200">Klasifikasi</label>
        <select name="klasifikasi_id" class="w-full p-2.5 border rounded-lg dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
          <option value="">-- Tidak ada --</option>
          <?php if (!empty($klasifikasi_list)) : foreach ($klasifikasi_list as $klid => $klnama) : ?>
              <option value="<?= $klid; ?>" <?= ((int)$buku['klasifikasi_id'] === $klid) ? 'selected' : ''; ?>><?= htmlspecialchars($klnama); ?></option>
          <?php endforeach;
          endif; ?>
        </select>
      </div>

      <div class="flex gap-3 pt-2">
        <button type="submit" class="flex-grow bg-orange-500 text-white font-bold py-2.5 rounded-lg hover:bg-orange-600">Simpan Perubahan</button>
        <a href="<?= ADMIN_URL ?>buku" class="bg-gray-200 text-gray-700 font-bold py-2.5 px-5 rounded-lg hover:bg-gray-300 dark:bg-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-600">Batal</a>
      </div>
    </form>
  </div>
</div>
<?php include 'footer.php'; ?>