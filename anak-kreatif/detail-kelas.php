<?php
require_once 'config/database.php';
include 'header.php';

// Validasi parameter ID kelas dari URL penyamaran SEO
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  header("Location: ../kelas");
  exit;
}

$id = (int)$_GET['id'];
$stmt = $conn->prepare("SELECT * FROM kelas_menulis WHERE id = :id");
$stmt->execute([':id' => $id]);
$kelas = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$kelas) {
  echo "<main class='flex-grow'><div class='text-center py-20 font-bold text-gray-500'>Program kelas tidak ditemukan! <a href='../kelas' class='text-sekolah underline'>Kembali ke Kelas</a></div></main>";
  include 'footer.php';
  exit;
}
?>

<!-- Wrapper <main> ditambahkan agar kompatibel dengan navigasi SPA -->
<main class="flex-grow">
  <section class="container mx-auto px-6 py-12 max-w-5xl">
    <!-- PERBAIKAN: href diubah menjadi "../kelas" agar mundur 1 level folder keluar dari directory SEO /kelas/ -->
    <!-- Menggunakan BASE_URL untuk konsistensi -->
    <a href="<?= BASE_URL ?>kelas" class="text-sm font-semibold text-gray-500 hover:text-sekolah inline-flex items-center gap-1 mb-6 transition-colors">
      ← Kembali ke Jadwal Kelas
    </a>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden grid grid-cols-1 md:grid-cols-12 gap-8 p-6 md:p-10">
      <!-- Area Gambar Brosur Kelas -->
      <div class="md:col-span-5 h-80 md:h-[400px] rounded-2xl overflow-hidden bg-gray-50 shadow-inner">
        <?php
        if (filter_var($kelas['gambar'], FILTER_VALIDATE_URL)) {
          $src_img = htmlspecialchars($kelas['gambar']);
        } elseif (!empty($kelas['gambar']) && file_exists('uploads/' . $kelas['gambar'])) {
          $src_img = '../uploads/' . htmlspecialchars($kelas['gambar']);
        } else {
          $src_img = 'https://unsplash.com';
        }
        ?>
        <img src="<?= $src_img; ?>" alt="Brosur Materi" class="w-full h-full object-cover">
      </div>

      <!-- Area Informasi Detail Konten Pembelajaran -->
      <div class="md:col-span-7 flex flex-col justify-between">
        <div>
          <span class="bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
            Sekolah Menulis Anak
          </span>
          <h1 class="text-3xl font-black text-tulisan mt-3 mb-2 leading-tight">
            <?= htmlspecialchars($kelas['nama_kelas']); ?>
          </h1>
          <p class="text-sm text-gray-500 mb-6">
            Dipandu oleh Mentor Profesional: <span class="font-bold text-sekolah"><?= htmlspecialchars($kelas['mentor']); ?></span>
          </p>

          <div class="grid grid-cols-2 gap-4 bg-gray-50 p-4 rounded-xl mb-6 border border-gray-100">
            <div>
              <span class="text-[10px] text-gray-400 block uppercase font-bold">📅 Jadwal Sesi:</span>
              <span class="text-xs font-semibold text-gray-700"><?= htmlspecialchars($kelas['jadwal']); ?></span>
            </div>
            <div>
              <span class="text-[10px] text-gray-400 block uppercase font-bold">👥 Sisa Kuota Belajar:</span>
              <span class="text-xs font-bold text-emerald-600"><?= $kelas['kuota']; ?> Kursi Anak</span>
            </div>
          </div>

          <div class="border-t border-gray-100 pt-4">
            <span class="text-xs text-gray-400 block mb-1">Detail Materi Kelas:</span>
            <p class="text-gray-600 text-sm leading-relaxed whitespace-pre-line">
              <?= htmlspecialchars($kelas['deskripsi_kelas']); ?>
            </p>
          </div>
        </div>

        <!-- Interaksi Biaya & Registrasi Belajar -->
        <div class="bg-emerald-50/50 p-5 rounded-2xl border border-emerald-100 flex flex-col sm:flex-row items-center justify-between gap-4 mt-8">
          <div>
            <span class="text-xs text-gray-400 block">Investasi Kelas</span>
            <span class="text-2xl font-black text-tulisan">
              Rp <?= number_format($kelas['harga_kelas'], 0, ',', '.'); ?>
            </span>
          </div>
          <button onclick="pesanLayanan('Kelas', <?= $kelas['id']; ?>)" class="w-full sm:w-auto bg-sekolah text-white px-8 py-3.5 rounded-xl font-bold shadow-md hover:bg-opacity-90 transition">
            ✍️ Amankan Slot Kelas
          </button>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>