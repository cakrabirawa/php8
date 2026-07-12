<?php
require_once 'config/database.php';
include 'header.php';

// Validasi parameter ID produk dari URL penyamaran SEO
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  header("Location: ../toko");
  exit;
}

$id = (int)$_GET['id'];

$sql = "SELECT p.*, k.nama AS kategori_name, l.nama AS klasifikasi_name 
        FROM produk_buku p 
        LEFT JOIN kategori_produk k ON p.kategori_id = k.id 
        LEFT JOIN klasifikasi_produk l ON p.klasifikasi_id = l.id 
        WHERE p.id = :id LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->execute([':id' => $id]);
$buku = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$buku) {
  echo "<div class='text-center py-20 font-bold text-gray-500'>Buku tidak ditemukan! <a href='" . BASE_URL . "toko' class='text-cerita underline'>Kembali ke Toko</a></div>";
  include 'footer.php';
  exit;
}
?>

<section class="container mx-auto px-6 py-12 max-w-5xl">
  <!-- PERBAIKAN: href diubah menjadi "../toko" agar mundur 1 level folder keluar dari directory SEO /toko/ -->
  <a href="<?= BASE_URL ?>toko" class="text-sm font-semibold text-gray-500 hover:text-cerita inline-flex items-center gap-1 mb-6 transition-colors">
    ← Kembali ke Katalog Toko
  </a>

  <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden grid grid-cols-1 md:grid-cols-12 gap-8 p-6 md:p-10">
    <!-- Area Gambar -->
    <div class="md:col-span-5 h-80 md:h-[450px] rounded-2xl overflow-hidden bg-gray-50 shadow-inner">
      <img src="<?= htmlspecialchars($buku['gambar']); ?>" alt="Sampul Buku" class="w-full h-full object-cover">
    </div>

    <!-- Area Informasi Detail -->
    <div class="md:col-span-7 flex flex-col justify-between">
      <div>
        <span class="bg-amber-100 text-amber-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
          Koleksi Cerita Anak
        </span>
        <h1 class="text-3xl font-black text-tulisan mt-3 mb-2 leading-tight">
          <?= htmlspecialchars($buku['judul']); ?>
        </h1>
        <p class="text-sm text-gray-500 mb-6">
          Ditulis oleh: <span class="font-bold text-cerita"><?= htmlspecialchars($buku['penulis']); ?></span>
        </p>
        <?php if (!empty($buku['kategori_name'])) : ?>
          <p class="text-sm text-gray-500 mb-4">Kategori: <span class="font-semibold text-gray-700"><?= htmlspecialchars($buku['kategori_name']); ?></span></p>
        <?php endif; ?>
        <?php if (!empty($buku['klasifikasi_name'])) : ?>
          <p class="text-sm text-gray-500 mb-4">Klasifikasi: <span class="font-semibold text-gray-700"><?= htmlspecialchars($buku['klasifikasi_name']); ?></span></p>
        <?php endif; ?>

        <div class="border-t border-b border-gray-100 py-4 my-4">
          <span class="text-xs text-gray-400 block mb-1">Sinopsis Buku:</span>
          <p class="text-gray-600 text-sm leading-relaxed whitespace-pre-line">
            <?= htmlspecialchars($buku['deskripsi']); ?>
          </p>
        </div>
      </div>

      <!-- Interaksi Harga & Pembelian -->
      <div class="bg-amber-50/50 p-5 rounded-2xl border border-amber-100 flex flex-col sm:flex-row items-center justify-between gap-4 mt-6">
        <div>
          <span class="text-xs text-gray-400 block">Stok Tersedia: <b><?= $buku['stok']; ?> Buku</b></span>
          <span class="text-2xl font-black text-tulisan">
            Rp <?= number_format($buku['harga'], 0, ',', '.'); ?>
          </span>
        </div>
        <button onclick="pesanLayanan('Buku', <?= $buku['id']; ?>)" class="w-full sm:w-auto bg-cerita text-white px-8 py-3.5 rounded-xl font-bold shadow-md hover:bg-opacity-90 transition">
          🛒 Ambil Buku Ini
        </button>
      </div>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>