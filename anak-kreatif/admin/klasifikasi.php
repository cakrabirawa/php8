<?php
require_once '../config/database.php';
if (!isset($_SESSION['login_admin'])) {
  header("Location: " . ADMIN_URL . "login");
  exit;
}

// Paging Klasifikasi
$batas = ADMIN_PAGING;
$halaman = isset($_GET['p']) ? (int)$_GET['p'] : 1;
if ($halaman < 1) $halaman = 1;
$offset = ($halaman - 1) * $batas;

$total_res = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM klasifikasi_produk"));
$total = $total_res['total'] ?? 0;
$total_hal = ceil($total / $batas);

$res = mysqli_query($conn, "SELECT * FROM klasifikasi_produk ORDER BY id DESC LIMIT $batas OFFSET $offset");
?>
<?php include 'header.php'; ?>

<div class="w-full">
  <div class="mb-6">
    <h1 class="text-2xl font-black text-gray-800 dark:text-zinc-100">📚 Manajemen Klasifikasi Produk</h1>
    <p class="text-gray-500 mt-1 dark:text-zinc-400">Atur klasifikasi produk (Books, Non Books, Digital).</p>
  </div>

  <div class="flex flex-col justify-between">
    <?php if (!empty($_SESSION['flash_error'])): ?>
      <div class="bg-red-50 text-red-700 p-3 rounded mb-4 dark:bg-red-500/10 dark:text-red-300"><?= htmlspecialchars($_SESSION['flash_error']); ?></div>
      <?php unset($_SESSION['flash_error']); ?>
    <?php endif; ?>

    <div class="flex justify-between items-center mb-4">
      <div class="flex-grow">
        <input type="text" id="live-search-klasifikasi" placeholder="Cari klasifikasi..." class="w-full max-w-sm p-2 border rounded-lg dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>
      <a href="<?= ADMIN_URL ?>klasifikasi-tambah" class="spa-trigger bg-sky-500 text-white font-bold py-2 px-4 rounded-md shadow-sm hover:bg-sky-600 transition flex-shrink-0">➕ Tambah Klasifikasi Baru</a>
    </div>

    <div class="bg-white p-4 rounded-xl shadow-sm overflow-x-auto mb-4 border dark:bg-zinc-900 dark:border-zinc-700">
      <table class="w-full text-left">
        <thead>
          <tr class="border-b text-gray-400 font-bold">
            <th class="p-2">Nama Klasifikasi</th>
            <th class="p-2">Slug</th>
            <th class="p-2 text-center">Status</th>
            <th class="p-2 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody id="table-klasifikasi-body">
          <?php if (mysqli_num_rows($res) > 0) : while ($r = mysqli_fetch_assoc($res)): ?>
              <tr class="border-b hover:bg-gray-50 dark:border-zinc-700 dark:hover:bg-zinc-800">
                <td class="p-2 font-medium"><?= htmlspecialchars($r['nama']); ?></td>
                <td class="p-2 text-gray-500 dark:text-zinc-400"><?= htmlspecialchars($r['slug']); ?></td>
                <td class="p-2 text-center">
                  <span class="px-2 py-0.5 rounded text-[10px] font-bold <?= (int)$r['is_active'] === 1 ? 'bg-emerald-50 text-emerald-600' : 'bg-gray-100 text-gray-500' ?>">
                    <?= (int)$r['is_active'] === 1 ? 'Aktif' : 'Nonaktif' ?>
                  </span>
                </td>
                <td class="p-2 text-center space-x-2 whitespace-nowrap font-bold">
                  <form action="<?= ADMIN_URL ?>klasifikasi-aksi" method="POST" class="inline ajax-form" data-action="reload">
                    <?= csrf_token_input(); ?>
                    <input type="hidden" name="toggle_status" value="<?= $r['id']; ?>">
                    <input type="hidden" name="status" value="<?= $r['is_active']; ?>">
                    <button type="submit" class="bg-transparent border-none p-0 font-bold cursor-pointer <?= (int)$r['is_active'] === 1 ? 'text-amber-600 hover:underline' : 'text-emerald-600 hover:underline' ?>"><?= (int)$r['is_active'] === 1 ? 'Nonaktifkan' : 'Aktifkan' ?></button>
                  </form>
                  <a href="<?= ADMIN_URL ?>klasifikasi-edit?id=<?= $r['id']; ?>" class="text-blue-600 hover:underline spa-trigger">Ubah</a>
                  <form action="<?= ADMIN_URL ?>klasifikasi-aksi" method="POST" class="inline ajax-form" data-action="reload" onsubmit="return confirm('Hapus klasifikasi ini?')">
                    <input type="hidden" name="hapus" value="<?= $r['id'] ?>"><input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <button type="submit" class="text-red-600 hover:underline bg-transparent border-none p-0 font-bold cursor-pointer">Hapus</button>
                  </form>
                </td>
              </tr>
            <?php endwhile;
          else: ?>
            <tr>
              <td colspan="4" id="no-results-klasifikasi" class="text-center text-gray-400 py-10">Belum ada klasifikasi.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <?php if ($total_hal > 1) : ?>
      <div class="flex justify-center items-center gap-1 bg-white p-2 rounded-xl border font-bold dark:bg-zinc-900 dark:border-zinc-700">
        <?php if ($halaman > 1) : ?>
          <a href="<?= ADMIN_URL ?>klasifikasi?p=<?= $halaman - 1; ?>" class="px-2.5 py-1 border rounded bg-white text-gray-600 hover:bg-gray-50 dark:bg-zinc-800 dark:text-zinc-300 dark:border-zinc-700 dark:hover:bg-zinc-700">←</a>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $total_hal; $i++) : ?>
          <a href="<?= ADMIN_URL ?>klasifikasi?p=<?= $i; ?>" class="px-2.5 py-1 rounded border <?= ($i === $halaman) ? 'bg-sky-500 text-white border-sky-500' : 'bg-white text-gray-600 hover:bg-gray-50 dark:bg-zinc-800 dark:text-zinc-300 dark:border-zinc-700 dark:hover:bg-zinc-700' ?>">
            <?= $i; ?>
          </a>
        <?php endfor; ?>
        <?php if ($halaman < $total_hal) : ?>
          <a href="<?= ADMIN_URL ?>klasifikasi?p=<?= $halaman + 1; ?>" class="px-2.5 py-1 border rounded bg-white text-gray-600 hover:bg-gray-50 dark:bg-zinc-800 dark:text-zinc-300 dark:border-zinc-700 dark:hover:bg-zinc-700">→</a>
        <?php endif; ?>
      </div>
    <?php endif; ?>

  </div>
</div>
<?php include 'footer.php'; ?>
<script>
  // Initialize live search for this page
  document.addEventListener('DOMContentLoaded', () => {
    initLiveSearch('live-search-klasifikasi', 'table-klasifikasi-body', 'no-results-klasifikasi');
  });
</script>