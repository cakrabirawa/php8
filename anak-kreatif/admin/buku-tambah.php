<?php
require_once '../config/database.php';
if (!isset($_SESSION['login_admin'])) {
  header("Location: " . ADMIN_URL . "login");
  exit;
}

// Ambil daftar kategori aktif untuk dropdown
$kategori_res = mysqli_query($conn, "SELECT id, nama FROM kategori_produk WHERE is_active = 1 ORDER BY nama");
$kategori_list = [];
if ($kategori_res) {
  while ($k = mysqli_fetch_assoc($kategori_res)) {
    $kategori_list[(int)$k['id']] = $k['nama'];
  }
}

// Ambil daftar klasifikasi produk untuk dropdown
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
    <h1 class="text-2xl font-black text-gray-800 dark:text-zinc-100">➕ Tambah Buku Cerita Baru</h1>
    <p class="text-gray-500 mt-1 dark:text-zinc-400">Tambah koleksi buku ke dalam katalog toko.</p>
  </div>
  <div class="bg-white p-8 rounded-2xl shadow-sm border w-full dark:bg-zinc-900 dark:border-zinc-700">
    <form action="<?= ADMIN_URL ?>buku-aksi" method="POST" enctype="multipart/form-data" class="space-y-4 text-sm ajax-form" data-redirect-url="<?= ADMIN_URL ?>buku">
      <?= csrf_token_input(); ?>
      <div><label class="block font-medium mb-1 dark:text-zinc-200">Judul Buku</label>
        <input type="text" name="judul" required class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-orange-300 outline-none dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>
      <div><label class="block font-medium mb-1 dark:text-zinc-200">Nama Penulis</label>
        <input type="text" name="penulis" required class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-orange-300 outline-none dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>
      <div class="grid grid-cols-2 gap-4">
        <div><label class="block font-medium mb-1 dark:text-zinc-200">Harga (Rp)</label>
          <input type="number" name="harga" required class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-orange-300 outline-none dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
        </div>
        <div><label class="block font-medium mb-1 dark:text-zinc-200">Stok</label>
          <input type="number" name="stok" required class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-orange-300 outline-none dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
        </div>
      </div>
      <div class="bg-gray-50 p-3 rounded-lg border space-y-3 dark:bg-zinc-800/50 dark:border-zinc-700">
        <div><label class="block text-xs font-semibold text-gray-500 mb-1 dark:text-zinc-400">Opsi 1: Upload File Gambar</label>
          <input type="file" name="gambar_upload" accept="image/*" class="w-full p-1 border bg-white rounded-md text-xs dark:bg-zinc-700 dark:border-zinc-600">
        </div>
        <div class="text-center text-xs text-gray-400 font-bold">ATAU</div>
        <div><label class="block text-xs font-semibold text-gray-500 mb-1 dark:text-zinc-400">Opsi 2: Tautan URL Gambar</label>
          <input type="url" name="gambar_url" placeholder="https://..." class="w-full p-2 border bg-white rounded-md text-xs focus:ring-2 focus:ring-orange-300 outline-none dark:bg-zinc-700 dark:border-zinc-600">
        </div>
      </div>
      <div><label class="block font-medium mb-1 dark:text-zinc-200">Sinopsis</label>
        <textarea name="deskripsi" required class="w-full p-2.5 border rounded-lg h-28 focus:ring-2 focus:ring-orange-300 outline-none dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100"></textarea>
      </div>
      <div>
        <label class="block font-medium mb-1 dark:text-zinc-200">Kategori</label>
        <select name="kategori_id" class="w-full p-2.5 border rounded-lg mb-2 focus:ring-2 focus:ring-orange-300 outline-none dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
          <option value="">-- Tidak ada --</option>
          <?php if (!empty($kategori_list)) : foreach ($kategori_list as $kid => $knama) : ?>
              <option value="<?= $kid; ?>"><?= htmlspecialchars($knama); ?></option>
          <?php endforeach;
          endif; ?>
        </select>

        <label class="block font-medium mb-1 dark:text-zinc-200">Klasifikasi</label>
        <select name="klasifikasi_id" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-orange-300 outline-none dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
          <option value="">-- Tidak ada --</option>
          <?php if (!empty($klasifikasi_list)) : foreach ($klasifikasi_list as $klid => $klnama) : ?>
              <option value="<?= $klid; ?>"><?= htmlspecialchars($klnama); ?></option>
          <?php endforeach;
          endif; ?>
        </select>
      </div>
      <div class="flex gap-3 pt-4">
        <button type="submit" class="flex-grow bg-orange-500 text-white font-bold py-2.5 rounded-lg hover:bg-orange-600 transition">Simpan Buku</button>
        <a href="<?= ADMIN_URL ?>buku" class="bg-gray-200 text-gray-700 font-bold py-2.5 px-5 rounded-lg hover:bg-gray-300 transition dark:bg-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-600">Batal</a>
      </div>
    </form>
  </div>
  <?php include 'footer.php'; ?>