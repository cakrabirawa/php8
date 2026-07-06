<?php
require_once '../config/database.php';

if (!isset($_SESSION['login_admin'])) {
  header("Location: " . ADMIN_URL . "login");
  exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id === 0) {
  header("Location: " . ADMIN_URL . "buku");
  exit;
}

$stmt = mysqli_prepare($conn, "SELECT * FROM produk_buku WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$buku = mysqli_fetch_assoc($result);

if (!$buku) {
  header("Location: " . ADMIN_URL . "buku");
  exit;
}

// Ambil daftar kategori dan klasifikasi
$kategori_res = mysqli_query($conn, "SELECT id, nama FROM kategori_produk WHERE is_active = 1 ORDER BY nama");
$klasifikasi_res = mysqli_query($conn, "SELECT id, nama FROM klasifikasi_produk WHERE is_active = 1 ORDER BY id");

include 'header.php';
?>

<div class="w-full">
  <div class="mb-6">
    <h1 class="text-2xl font-black text-gray-800 dark:text-zinc-100">✏️ Edit Buku Cerita</h1>
    <p class="text-gray-500 mt-1 dark:text-zinc-400">Perbarui detail untuk buku "<?= htmlspecialchars($buku['judul']); ?>".</p>
  </div>

  <div class="bg-white p-6 rounded-2xl shadow-sm border w-full dark:bg-zinc-900 dark:border-zinc-700">
    <form action="<?= ADMIN_URL ?>buku-aksi" method="POST" enctype="multipart/form-data" class="space-y-5 ajax-form" data-redirect-url="<?= ADMIN_URL ?>buku">
      <?= csrf_token_input(); ?>
      <input type="hidden" name="id" value="<?= $buku['id']; ?>">
      <input type="hidden" name="action_type" value="update">
      <input type="hidden" name="gambar_lama" value="<?= htmlspecialchars($buku['gambar']); ?>">

      <div>
        <label class="block font-semibold mb-1 dark:text-zinc-200">Judul Buku</label>
        <input type="text" name="judul" value="<?= htmlspecialchars($buku['judul']); ?>" required class="w-full p-2.5 border rounded-lg focus:ring-1 focus:ring-orange-500 outline-none font-bold text-gray-800 dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
          <label class="block font-semibold mb-1 dark:text-zinc-200">Penulis</label>
          <input type="text" name="penulis" value="<?= htmlspecialchars($buku['penulis']); ?>" required class="w-full p-2.5 border rounded-lg focus:ring-1 focus:ring-orange-500 outline-none font-bold text-gray-800 dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
        </div>
        <div class="grid grid-cols-2 gap-3">
          <div>
            <label class="block font-semibold mb-1 dark:text-zinc-200">Harga (Rp)</label>
            <input type="number" name="harga" value="<?= $buku['harga']; ?>" required class="w-full p-2.5 border rounded-lg focus:ring-1 focus:ring-orange-500 outline-none font-bold text-gray-800 dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
          </div>
          <div>
            <label class="block font-semibold mb-1 dark:text-zinc-200">Stok</label>
            <input type="number" name="stok" value="<?= $buku['stok']; ?>" required class="w-full p-2.5 border rounded-lg focus:ring-1 focus:ring-orange-500 outline-none font-bold text-gray-800 dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
          </div>
        </div>
      </div>

      <div class="flex items-start gap-4 pt-2">
        <?php
        $img_src = '';
        if (!empty($buku['gambar'])) {
          $img_src = (filter_var($buku['gambar'], FILTER_VALIDATE_URL)) ? $buku['gambar'] : '../uploads/' . $buku['gambar'];
        }
        ?>
        <?php if (!empty($img_src)) : ?>
          <img src="<?= htmlspecialchars($img_src); ?>" alt="Gambar Sampul" class="w-24 h-32 rounded-md object-cover border-2 border-white shadow-md flex-shrink-0">
        <?php endif; ?>
        <div class="flex-grow space-y-3">
          <div>
            <label class="block font-semibold mb-1 dark:text-zinc-200">Ganti Gambar Sampul (Opsional)</label>
            <input type="file" name="gambar_upload" accept="image/*" class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 dark:file:bg-orange-500/10 dark:file:text-orange-300 dark:hover:file:bg-orange-500/20">
          </div>
          <div>
            <label class="block font-semibold mb-1 dark:text-zinc-200">Atau gunakan URL Gambar Eksternal</label>
            <input type="url" name="gambar_url" placeholder="https://example.com/image.jpg" class="w-full p-2.5 border rounded-lg focus:ring-1 focus:ring-orange-500 outline-none font-medium text-sm text-gray-800 dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
          </div>
        </div>
      </div>

      <div><label class="block font-semibold mb-1 dark:text-zinc-200">Deskripsi</label><textarea name="deskripsi" required class="w-full p-2.5 border rounded-lg h-28 focus:ring-1 focus:ring-orange-500 outline-none font-medium text-sm text-gray-800 dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100"><?= htmlspecialchars($buku['deskripsi']); ?></textarea></div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div><label class="block font-semibold mb-1 dark:text-zinc-200">Kategori Produk</label><select name="kategori_id" class="w-full p-2.5 border rounded-lg focus:ring-1 focus:ring-orange-500 outline-none font-medium text-sm text-gray-800 dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
            <option value="">-- Pilih Kategori --</option><?php while ($kat = mysqli_fetch_assoc($kategori_res)) : ?><option value="<?= $kat['id']; ?>" <?= ($buku['kategori_id'] == $kat['id']) ? 'selected' : ''; ?>><?= htmlspecialchars($kat['nama']); ?></option><?php endwhile; ?>
          </select></div>
        <div><label class="block font-semibold mb-1 dark:text-zinc-200">Klasifikasi Produk</label><select name="klasifikasi_id" class="w-full p-2.5 border rounded-lg focus:ring-1 focus:ring-orange-500 outline-none font-medium text-sm text-gray-800 dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
            <option value="">-- Pilih Klasifikasi --</option><?php while ($klas = mysqli_fetch_assoc($klasifikasi_res)) : ?><option value="<?= $klas['id']; ?>" <?= ($buku['klasifikasi_id'] == $klas['id']) ? 'selected' : ''; ?>><?= htmlspecialchars($klas['nama']); ?></option><?php endwhile; ?>
          </select></div>
      </div>

      <div class="flex gap-2 pt-2 font-semibold"><button type="submit" class="flex-grow bg-orange-500 text-white py-2.5 rounded-lg hover:bg-orange-600 transition">Simpan Perubahan</button><a href="<?= ADMIN_URL ?>buku" class="btn-cancel bg-gray-200 text-gray-700 py-2.5 px-6 rounded-lg hover:bg-gray-300 text-center dark:bg-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-600">Batal</a></div>
    </form>
  </div>
</div>

<?php include 'footer.php'; ?>