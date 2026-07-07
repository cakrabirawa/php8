<?php
require_once 'config/database.php';

// Lacak kunjungan ke halaman Kelas
track_page_visit($conn, 'kelas');

include 'header.php';

// 1. Tentukan batas data kelas per halaman (Paging)
$batas = 4;

// 2. Ambil nomor halaman dari URL
$halaman = isset($_GET['p']) ? (int)$_GET['p'] : 1;
if ($halaman < 1) {
  $halaman = 1;
}

// 3. Hitung offset permulaan query data
$offset = ($halaman - 1) * $batas;

// 4. Hitung total seluruh baris kelas di database
$stmt_total = $conn->query("SELECT COUNT(*) FROM kelas_menulis");
$total_kelas = $stmt_total->fetchColumn();

// 5. Hitung total halaman kelas
$total_halaman = ceil($total_kelas / $batas);

// 6. Ambil data kelas sesuai limit halaman aktif
$stmt_data = $conn->prepare("SELECT * FROM kelas_menulis ORDER BY id DESC LIMIT :limit OFFSET :offset");
$stmt_data->bindValue(':limit', $batas, PDO::PARAM_INT);
$stmt_data->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt_data->execute();
?>
<!-- Wrapper <main> ditambahkan agar kompatibel dengan navigasi SPA -->
<main class="flex-grow">
  <section class="bg-gradient-to-r from-emerald-100 to-teal-100 py-12 px-6 text-center">
    <div class="max-w-xl mx-auto">
      <h1 class="text-3xl font-extrabold text-tulisan mb-2">✍️ Kelas Menulis Kreatif</h1>
      <p class="text-gray-600 text-sm">Bimbingan interaktif bersama mentor berpengalaman untuk si kecil.</p>
    </div>
  </section>

  <section class="container mx-auto px-6 py-12 max-w-5xl">
    <!-- List Grid Kelas -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <?php if ($stmt_data->rowCount() > 0) : while ($kelas = $stmt_data->fetch(PDO::FETCH_ASSOC)) : ?>

          <?php
          // MEMBENTUK TAUTAN LINK BERBASIS SEO SLUG UNTUK KELAS
          $slug_kelas = buat_slug($kelas['nama_kelas']);
          $url_kelas_seo = "kelas/" . $kelas['id'] . "-" . $slug_kelas;
          ?>

          <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col md:flex-row group">

            <!-- AREA DETEKSI SOURCE GAMBAR -->
            <div class="w-full md:w-44 h-48 md:h-auto overflow-hidden bg-gray-100 flex-shrink-0">
              <?php
              if (filter_var($kelas['gambar'], FILTER_VALIDATE_URL)) {
                $src = htmlspecialchars($kelas['gambar']);
              } elseif (!empty($kelas['gambar']) && file_exists('uploads/' . $kelas['gambar'])) {
                $src = 'uploads/' . htmlspecialchars($kelas['gambar']);
              } else {
                $src = 'https://unsplash.com';
              }
              ?>
              <img src="<?= $src; ?>" alt="Brosur Kelas" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
            </div>

            <div class="p-6 flex-grow flex flex-col justify-between">
              <div>
                <!-- Implementasi Tautan Bersih SEO pada Judul Kelas -->
                <h3 class="text-xl font-bold text-tulisan hover:text-sekolah transition-colors line-clamp-2">
                  <a href="<?= BASE_URL . $url_kelas_seo; ?>"><?= htmlspecialchars($kelas['nama_kelas']); ?></a>
                </h3>
                <p class="text-xs text-gray-500 mb-3">🧑‍🏫 Mentor: <span class="font-medium text-tulisan"><?= htmlspecialchars($kelas['mentor']); ?></span></p>
                <p class="text-gray-600 text-sm line-clamp-3 mb-4"><?= htmlspecialchars($kelas['deskripsi_kelas']); ?></p>
              </div>
              <div class="pt-4 border-t border-gray-50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="text-xs text-gray-500 space-y-1">
                  <div>📅 <?= htmlspecialchars($kelas['jadwal']); ?></div>
                  <div>👥 Kuota: <span class="font-bold text-emerald-600"><?= $kelas['kuota']; ?> Anak</span></div>
                </div>
                <div class="text-right flex sm:flex-col items-center sm:items-end justify-between sm:justify-center gap-2">
                  <span class="block text-xl font-black text-sekolah">Bagian Rp <?= number_format($kelas['harga_kelas'], 0, ',', '.'); ?></span>
                  <div class="flex gap-1.5 w-full justify-end">
                    <!-- Implementasi Tautan Bersih SEO pada Tombol Detail -->
                    <a href="<?= BASE_URL . $url_kelas_seo; ?>" class="bg-gray-100 text-gray-700 px-3 py-2 rounded-xl font-bold text-xs flex items-center justify-center hover:bg-gray-200">
                      Materi
                    </a>
                    <button onclick="pesanLayanan('Kelas', <?= $kelas['id']; ?>)" class="bg-sekolah text-white px-4 py-2 rounded-xl font-bold text-xs shadow-md">Daftar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

        <?php endwhile;
      else : ?>
        <p class="col-span-full text-center text-gray-500 py-12">Belum ada kelas dibuka.</p>
      <?php endif; ?>
    </div>

    <!-- ELEMEN TOMBOL NAVIGASI PAGING KELAS -->
    <?php if ($total_halaman > 1) : ?>
      <div class="flex justify-center items-center gap-2 mt-12">
        <?php if ($halaman > 1) : ?>
          <a href="<?= BASE_URL ?>kelas?p=<?= $halaman - 1; ?>" class="px-4 py-2 border rounded-xl bg-white font-bold text-xs text-gray-600 hover:bg-gray-50 shadow-sm transition">← Sebelumnya</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_halaman; $i++) : ?>
          <a href="<?= BASE_URL ?>kelas?p=<?= $i; ?>" class="px-3.5 py-2 rounded-xl text-xs font-bold transition shadow-sm <?= ($i === $halaman) ? 'bg-sekolah text-white' : 'bg-white border text-gray-600 hover:bg-gray-50' ?>">
            <?= $i; ?>
          </a>
        <?php endfor; ?>

        <?php if ($halaman < $total_halaman) : ?>
          <a href="<?= BASE_URL ?>kelas?p=<?= $halaman + 1; ?>" class="px-4 py-2 border rounded-xl bg-white font-bold text-xs text-gray-600 hover:bg-gray-50 shadow-sm transition">Berikutnya →</a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </section>
</main>

<?php include 'footer.php'; ?>