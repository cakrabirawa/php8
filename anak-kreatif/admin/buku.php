<?php
require_once '../config/database.php';
if (!isset($_SESSION['login_admin'])) {
  header("Location: " . ADMIN_URL . "login");
  exit;
}

// Paging Sektor Buku
$limit_b = ADMIN_PAGING;
$hal_b = isset($_GET['p']) ? (int)$_GET['p'] : 1;
if ($hal_b < 1) $hal_b = 1;
$offset_b = ($hal_b - 1) * $limit_b;

$stmt_total = mysqli_prepare($conn, "SELECT COUNT(*) AS total FROM produk_buku");
mysqli_stmt_execute($stmt_total);
$total_b_res = mysqli_stmt_get_result($stmt_total);
$total_buku = mysqli_fetch_assoc($total_b_res)['total'] ?? 0;
mysqli_stmt_close($stmt_total);

$total_hal_b = ceil($total_buku / $limit_b);

$query = "
    SELECT pb.*, kp.nama AS kategori_nama, kls.nama AS klasifikasi_nama
    FROM produk_buku pb
    LEFT JOIN kategori_produk kp ON pb.kategori_id = kp.id
    LEFT JOIN klasifikasi_produk kls ON pb.klasifikasi_id = kls.id
    ORDER BY pb.id DESC
    LIMIT ? OFFSET ?
";
$stmt_buku = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt_buku, 'ii', $limit_b, $offset_b);
mysqli_stmt_execute($stmt_buku);
$buku_res = mysqli_stmt_get_result($stmt_buku);
?>
<?php include 'header.php'; ?>

<div class="w-full">
  <div class="mb-6">
    <h1 class="text-2xl font-black text-gray-800 dark:text-zinc-100">📚 Manajemen Katalog Buku</h1>
    <p class="text-gray-500 mt-1 dark:text-zinc-400">Kelola daftar buku cerita yang dijual di toko web.</p>
  </div>

  <div class="flex flex-col justify-between">
    <div class="flex justify-between items-center mb-4">
      <div class="flex-grow">
        <input type="text" id="live-search-buku" placeholder="Cari buku berdasarkan judul, kategori, dll..." class="w-full max-w-sm p-2 border rounded-lg dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>
      <a href="<?= ADMIN_URL ?>buku-tambah" class="spa-trigger bg-orange-500 text-white font-bold py-2 px-4 rounded-md shadow-sm hover:bg-orange-600 transition flex-shrink-0">➕ Tambah Buku Baru</a>
    </div>

    <div class="bg-white p-4 rounded-xl shadow-sm overflow-x-auto mb-4 border dark:bg-zinc-900 dark:border-zinc-700">
      <table class="w-full text-left">
        <thead>
          <tr class="border-b text-gray-400 font-bold">
            <th class="p-2">Judul Buku</th>
            <th class="p-2">Kategori</th>
            <th class="p-2">Klasifikasi</th>
            <th class="p-2">Harga</th>
            <th class="p-2">Stok</th>
            <th class="p-2 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody id="table-buku-body">
          <?php if (mysqli_num_rows($buku_res) > 0) : while ($r = mysqli_fetch_assoc($buku_res)): ?>
              <tr class="border-b hover:bg-gray-50 dark:border-zinc-700 dark:hover:bg-zinc-800">
                <td class="p-2 font-medium"><?= htmlspecialchars($r['judul']); ?></td>
                <td class="p-2 text-sm text-gray-600 dark:text-zinc-400"><?= htmlspecialchars($r['kategori_nama'] ?? '-'); ?></td>
                <td class="p-2 text-sm text-gray-600 dark:text-zinc-400"><?= htmlspecialchars($r['klasifikasi_nama'] ?? '-'); ?></td>
                <td class="p-2">Rp <?= number_format($r['harga'], 0, ',', '.'); ?></td>
                <td class="p-2"><?= $r['stok']; ?></td>
                <td class="p-2 text-center space-x-2 whitespace-nowrap font-bold">
                  <form action="<?= ADMIN_URL ?>buku-aksi" method="POST" class="inline" onsubmit="return confirm('Duplikat buku ini?')">
                    <input type="hidden" name="duplikat" value="<?= $r['id'] ?>"><input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <button type="submit" class="text-amber-600 hover:underline bg-transparent border-none p-0 font-bold cursor-pointer">Salin</button>
                  </form>
                  <a href="<?= ADMIN_URL ?>buku-edit?id=<?= $r['id']; ?>" class="text-blue-600 hover:underline spa-trigger">Edit</a>
                  <form action="<?= ADMIN_URL ?>buku-aksi" method="POST" class="inline" onsubmit="return confirm('Hapus buku ini?')">
                    <input type="hidden" name="hapus" value="<?= $r['id'] ?>"><input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <button type="submit" class="text-red-600 hover:underline bg-transparent border-none p-0 font-bold cursor-pointer">Hapus</button>
                  </form>
                </td>
              </tr>
            <?php endwhile;
          else: ?>
            <tr>
              <td colspan="6" id="no-results-buku" class="text-center text-gray-400 py-10">Belum ada data buku di dalam katalog.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <?php if ($total_hal_b > 1) : ?>
      <div class="flex justify-center gap-1 bg-white p-2 rounded-xl border font-bold dark:bg-zinc-900 dark:border-zinc-700">
        <?php for ($i = 1; $i <= $total_hal_b; $i++) : ?>
          <a href="<?= ADMIN_URL ?>buku?p=<?= $i; ?>" class="px-3 py-1 rounded border <?= ($i === $hal_b) ? 'bg-orange-500 text-white border-orange-500' : 'bg-white text-gray-600 hover:bg-gray-50 dark:bg-zinc-800 dark:text-zinc-300 dark:border-zinc-700 dark:hover:bg-zinc-700' ?>"><?= $i; ?></a>
        <?php endfor; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
<?php include 'footer.php'; ?>
<script>
  // Initialize live search for this page
  document.addEventListener('DOMContentLoaded', () => {
    initLiveSearch('live-search-buku', 'table-buku-body', 'no-results-buku');
  });
</script>