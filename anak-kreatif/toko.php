<?php
require_once 'config/database.php';

// Lacak kunjungan ke halaman Toko
track_page_visit($conn, 'toko');

include 'header.php';

// 1. Tentukan batas data per halaman (Paging)
$batas = 8;

// 2. Ambil nomor halaman dari URL (jika tidak ada, set ke halaman 1)
$halaman = isset($_GET['p']) ? (int)$_GET['p'] : 1;
if ($halaman < 1) {
  $halaman = 1;
}

// 3. Hitung offset untuk permulaan data query
$offset = ($halaman - 1) * $batas;

// Ambil daftar kategori aktif untuk filter
$stmt_kat = $conn->query("SELECT id, nama FROM kategori_produk WHERE is_active = 1 ORDER BY nama");
$kategori_list = $stmt_kat->fetchAll(PDO::FETCH_KEY_PAIR);

// Ambil daftar klasifikasi untuk tampilkan di kartu
$stmt_klas = $conn->query("SELECT id, nama FROM klasifikasi_produk WHERE is_active = 1 ORDER BY id");
$klasifikasi_list = $stmt_klas->fetchAll(PDO::FETCH_KEY_PAIR);

// dukung filter klasifikasi via slug (GET `klas`)
$selected_klas = null;
if (!empty($_GET['klas'])) {
  $slug = $_GET['klas'];
  $stmtk = $conn->prepare("SELECT id FROM klasifikasi_produk WHERE slug = :slug AND is_active = 1 LIMIT 1");
  $stmtk->execute([':slug' => $slug]);
  $found_id = $stmtk->fetchColumn();
  if ($found_id) $selected_klas = (int)$found_id;
}

// periksa filter kategori dari query string
$selected_kategori = isset($_GET['kat']) && is_numeric($_GET['kat']) ? (int)$_GET['kat'] : null;

// 4. Hitung total seluruh data buku di database (prepared statement), dukung filter kategori
$where_clauses = ['1=1']; // Base condition
$bind_params = [];

if (!is_null($selected_kategori)) {
  $where_clauses[] = 'kategori_id = :kat_id';
  $bind_params[':kat_id'] = $selected_kategori;
}
if (!is_null($selected_klas)) {
  $where_clauses[] = 'klasifikasi_id = :klas_id';
  $bind_params[':klas_id'] = $selected_klas;
}

$where_sql = count($where_clauses) > 0 ? ' WHERE ' . implode(' AND ', $where_clauses) : '';

// Hitung total buku
$total_buku = 0;
$sql_total = "SELECT COUNT(*) AS total FROM produk_buku" . $where_sql;
$stmt_total = $conn->prepare($sql_total);
$stmt_total->execute($bind_params);
$total_buku = $stmt_total->fetchColumn();

// 5. Hitung total halaman yang tersedia
$total_halaman = ceil($total_buku / $batas);

// 6. Ambil data buku berdasarkan limit batas dan offset halaman aktif (prepared statement), dengan filter kategori/klasifikasi
$sql = "SELECT * FROM produk_buku" . $where_sql . " ORDER BY id DESC LIMIT :limit OFFSET :offset";
$stmt = $conn->prepare($sql);

// Bind filter parameters
foreach ($bind_params as $key => $value) {
  $stmt->bindValue($key, $value);
}
$stmt->bindValue(':limit', $batas, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
?>

<!-- Wrapper <main> ditambahkan agar kompatibel dengan navigasi SPA -->
<main class="flex-grow">
  <!-- Banner & Kolom Pencarian Dinamis -->
  <section class="bg-gradient-to-r from-amber-100 to-amber-200 py-12 px-6 text-center">
    <div class="max-w-xl mx-auto">
      <h1 class="text-3xl font-extrabold text-tulisan mb-2">📚 Toko Buku Anak</h1>
      <p class="text-gray-600 text-sm mb-6">Pilihan dongeng dan buku panduan kreatif terbaik untuk si kecil.</p>

      <!-- Input Search Bar -->
      <div class="relative max-w-md mx-auto">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">🔍</span>
        <input
          type="text"
          id="search-book"
          placeholder="Cari judul cerita atau nama penulis..."
          class="w-full pl-10 pr-4 py-3 rounded-xl border border-amber-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-cerita bg-white font-medium text-sm">
      </div>

      <!-- Filter Kategori -->
      <div class="mt-3">
        <?php
        $form_action = BASE_URL . 'toko';
        if (!empty($_GET['klas'])) {
          $form_action .= '/klasifikasi/' . urlencode($_GET['klas']);
        }
        ?>
        <form method="GET" id="filter-form" action="<?= $form_action; ?>">
          <select name="kat" onchange="document.getElementById('filter-form').submit()" class="p-2 rounded-md border bg-white text-sm">
            <option value="">Semua Kategori</option>
            <?php if (!empty($kategori_list)) : foreach ($kategori_list as $kid => $knama) : ?>
                <option value="<?= $kid; ?>" <?= (!is_null($selected_kategori) && $selected_kategori == $kid) ? 'selected' : ''; ?>><?= htmlspecialchars($knama); ?></option>
            <?php endforeach;
            endif; ?>
          </select>
        </form>
      </div>
    </div>
  </section>

  <section class="container mx-auto px-6 py-12">
    <!-- Grid Katalog Buku -->
    <div id="book-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php if ($stmt->rowCount() > 0) : while ($buku = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>

          <?php
          // MEMBENTUK TAUTAN LINK BERBASIS SEO SLUG
          // Menghasilkan pola string terpadu: toko/ID-judul-buku-slug
          $slug_buku = buat_slug($buku['judul']);
          $url_detail_seo = "toko/" . $buku['id'] . "-" . $slug_buku;
          ?>

          <div
            class="book-card bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col justify-between transform transition duration-200"
            data-judul="<?= strtolower(htmlspecialchars($buku['judul'])); ?>"
            data-penulis="<?= strtolower(htmlspecialchars($buku['penulis'])); ?>">
            <div class="h-48 overflow-hidden relative bg-gray-100">
              <?php
              $img_src = $buku['gambar'];
              if (!filter_var($img_src, FILTER_VALIDATE_URL) && !empty($img_src)) {
                $img_src = BASE_URL . 'uploads/' . $img_src;
              }
              ?>
              <img src="<?= htmlspecialchars($img_src); ?>" alt="Buku" class="w-full h-full object-cover">
              <span class="absolute top-3 right-3 bg-white/90 text-xs font-bold px-2.5 py-1 rounded-full">Stok: <?= $buku['stok']; ?></span>
            </div>
            <div class="p-5 flex-grow flex flex-col justify-between">
              <div>
                <span class="text-xs font-semibold text-cerita uppercase">Karya: <?= htmlspecialchars($buku['penulis']); ?></span>
                <h3 class="text-lg font-bold text-tulisan mt-1 mb-2 line-clamp-2 hover:text-cerita transition-colors">
                  <!-- Implementasi Tautan Bersih SEO pada Judul -->
                  <a href="<?= BASE_URL . $url_detail_seo; ?>"><?= htmlspecialchars($buku['judul']); ?></a>
                </h3>
                <p class="text-gray-500 text-xs line-clamp-3 mb-2"><?= htmlspecialchars($buku['deskripsi']); ?></p>
                <?php $kat_name = isset($buku['kategori_id']) && isset($kategori_list[(int)$buku['kategori_id']]) ? $kategori_list[(int)$buku['kategori_id']] : null; ?>
                <?php if ($kat_name) : ?>
                  <div class="text-[11px] text-gray-500 uppercase font-semibold tracking-wide">Kategori: <?= htmlspecialchars($kat_name); ?></div>
                <?php endif; ?>
                <?php $klas_name = isset($buku['klasifikasi_id']) && isset($klasifikasi_list[(int)$buku['klasifikasi_id']]) ? $klasifikasi_list[(int)$buku['klasifikasi_id']] : null; ?>
                <?php if ($klas_name) : ?>
                  <div class="text-[11px] text-gray-500 uppercase font-semibold tracking-wide">Klasifikasi: <?= htmlspecialchars($klas_name); ?></div>
                <?php endif; ?>
              </div>
              <div class="mt-auto pt-4 border-t border-gray-50">
                <div class="flex items-center justify-between mb-3">
                  <span class="text-xs text-gray-400">Harga</span>
                  <span class="text-lg font-extrabold">Rp <?= number_format($buku['harga'], 0, ',', '.'); ?></span>
                </div>
                <div class="grid grid-cols-5 gap-2">
                  <!-- Implementasi Tautan Bersih SEO pada Tombol Detail -->
                  <a href="<?= BASE_URL . $url_detail_seo; ?>" class="col-span-2 bg-gray-100 text-gray-700 text-center py-2.5 rounded-xl font-bold text-xs flex items-center justify-center hover:bg-gray-200">
                    Detail
                  </a>
                  <button onclick="pesanLayanan('Buku', <?= $buku['id']; ?>)" class="col-span-3 bg-cerita text-white py-2.5 rounded-xl font-bold text-xs shadow-md">
                    🛒 Ambil
                  </button>
                </div>
              </div>
            </div>
          </div>

        <?php endwhile; ?>

        <div id="no-results" class="hidden col-span-full text-center text-gray-500 py-12">
          <span class="text-3xl">🏜️</span>
          <p class="mt-2">Buku atau penulis yang Anda cari tidak ditemukan.</p>
        </div>

      <?php else : ?>
        <p class="col-span-full text-center text-gray-500 py-12">Belum ada koleksi buku.</p>
      <?php endif; ?>
    </div>

    <!-- Elemen Tombol Navigasi Paging Toko -->
    <?php if ($total_halaman > 1) : ?>
      <?php
      $base_toko_url = BASE_URL . 'toko';
      if (!empty($_GET['klas'])) {
        $base_toko_url .= '/klasifikasi/' . urlencode($_GET['klas']);
      }
      $q_params = [];
      if (!empty($_GET['kat'])) $q_params['kat'] = $_GET['kat'];
      ?>
      <div id="pagination-container" class="flex justify-center items-center gap-2 mt-12">
        <?php if ($halaman > 1) : ?>
          <?php $q_params['p'] = $halaman - 1; ?>
          <a href="<?= $base_toko_url . '?' . http_build_query($q_params); ?>" class="px-4 py-2 border rounded-xl bg-white font-bold text-xs text-gray-600 hover:bg-gray-50 shadow-sm transition">← Sebentar</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_halaman; $i++) : ?>
          <?php $q_params['p'] = $i; ?>
          <a href="<?= $base_toko_url . '?' . http_build_query($q_params); ?>" class="px-3.5 py-2 rounded-xl text-xs font-bold transition shadow-sm <?= ($i === $halaman) ? 'bg-cerita text-white' : 'bg-white border text-gray-600 hover:bg-gray-50' ?>">
            <?= $i; ?>
          </a>
        <?php endfor; ?>

        <?php if ($halaman < $total_halaman) : ?>
          <?php $q_params['p'] = $halaman + 1; ?>
          <a href="<?= $base_toko_url . '?' . http_build_query($q_params); ?>" class="px-4 py-2 border rounded-xl bg-white font-bold text-xs text-gray-600 hover:bg-gray-50 shadow-sm transition">Lanjut →</a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </section>
</main>

<script>
  function initTokoSearch() {
    const searchInput = document.getElementById('search-book');
    const bookCards = document.querySelectorAll('.book-card');
    const noResults = document.getElementById('no-results');
    const pagingContainer = document.getElementById('pagination-container');

    if (searchInput) {
      searchInput.addEventListener('input', (e) => {
        const keyword = e.target.value.toLowerCase().trim();
        let hasVisibleCard = false;

        bookCards.forEach(card => {
          const judul = card.getAttribute('data-judul');
          const penulis = card.getAttribute('data-penulis');

          if (judul.includes(keyword) || penulis.includes(keyword)) {
            card.style.display = 'flex';
            hasVisibleCard = true;
          } else {
            card.style.display = 'none';
          }
        });

        if (hasVisibleCard || keyword === '') {
          noResults.classList.add('hidden');
          if (pagingContainer) pagingContainer.classList.remove('hidden');
        } else {
          noResults.classList.remove('hidden');
          if (pagingContainer) pagingContainer.classList.add('hidden');
        }
      });
    }
  }
  // Panggil fungsi inisialisasi untuk load halaman pertama kali
  initTokoSearch();
</script>

<?php include 'footer.php'; ?>