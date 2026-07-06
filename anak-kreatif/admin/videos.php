<?php
require_once '../config/database.php';
if (!isset($_SESSION['login_admin'])) {
  header("Location: " . ADMIN_URL . "login");
  exit;
}

// Konfigurasi Paging Tabel Video Admin
$limit = ADMIN_PAGING;
$hal = isset($_GET['p']) ? (int)$_GET['p'] : 1;
if ($hal < 1) {
  $hal = 1;
}
$offset = ($hal - 1) * $limit;

$stmt_total = mysqli_prepare($conn, "SELECT COUNT(*) AS total FROM videos");
mysqli_stmt_execute($stmt_total);
$total_res = mysqli_stmt_get_result($stmt_total);
$total_videos = mysqli_fetch_assoc($total_res)['total'] ?? 0;
mysqli_stmt_close($stmt_total);

$total_hal = ceil($total_videos / $limit);

$stmt_videos = mysqli_prepare($conn, "SELECT * FROM videos ORDER BY id DESC LIMIT ? OFFSET ?");
mysqli_stmt_bind_param($stmt_videos, 'ii', $limit, $offset);
mysqli_stmt_execute($stmt_videos);
$v_res = mysqli_stmt_get_result($stmt_videos);
?>
<?php include 'header.php'; ?>

<div class="w-full">
  <div class="mb-6">
    <h1 class="text-2xl font-black text-gray-800 dark:text-zinc-100">🎬 Manajemen Dokumentasi Video</h1>
    <p class="text-gray-500 mt-1 dark:text-zinc-400">Kelola berkas video unggahan lokal (.mp4) atau integrasi sematan tautan YouTube.</p>
  </div>

  <div class="flex flex-col justify-between">
    <div class="flex justify-between items-center mb-4">
      <div class="flex-grow">
        <input type="text" id="live-search-videos" placeholder="Cari video berdasarkan judul..." class="w-full max-w-sm p-2 border rounded-lg dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>
      <a href="<?= ADMIN_URL ?>videos-tambah" class="spa-trigger bg-indigo-600 text-white font-bold py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 transition flex-shrink-0">➕ Tambah Video Baru</a>
    </div>

    <div class="bg-white p-4 rounded-xl shadow-sm border overflow-x-auto mb-4 dark:bg-zinc-900 dark:border-zinc-700">
      <table class="w-full text-left">
        <thead>
          <tr class="border-b text-gray-400 font-bold">
            <th class="p-2">Judul Dokumentasi Video</th>
            <th class="p-2 text-center">Sumber</th>
            <th class="p-2 text-center">Status</th>
            <th class="p-2 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody id="table-videos-body">
          <?php if (mysqli_num_rows($v_res) > 0): while ($r = mysqli_fetch_assoc($v_res)):
              $is_active = (int)($r['is_active'] ?? 1) === 1;
          ?>
              <tr class="border-b hover:bg-gray-50 dark:border-zinc-700 dark:hover:bg-zinc-800">
                <td class="p-2 font-medium max-w-[240px] truncate"><?= htmlspecialchars($r['judul_video']); ?></td>
                <td class="p-2 uppercase text-center"><span class="px-2 py-0.5 rounded text-[10px] font-bold <?= $r['tipe_sumber'] === 'youtube' ? 'bg-red-50 text-red-600' : 'bg-emerald-50 text-emerald-600' ?>"><?= $r['tipe_sumber']; ?></span></td>
                <td class="p-2 text-center">
                  <form action="<?= ADMIN_URL ?>videos-aksi" method="POST" class="inline ajax-form" data-action="reload">
                    <?= csrf_token_input(); ?>
                    <input type="hidden" name="toggle_status" value="<?= $r['id']; ?>">
                    <input type="hidden" name="status" value="<?= $r['is_active'] ?? 1; ?>">
                    <button type="submit" class="font-bold text-[10px] bg-transparent border-none cursor-pointer p-0 <?= $is_active ? 'text-emerald-600 hover:text-emerald-700' : 'text-gray-400 hover:text-gray-600' ?>"><?= $is_active ? 'Tampil' : 'Arsip' ?></button>
                  </form>
                </td>
                <td class="p-2 text-center font-bold space-x-2 whitespace-nowrap">
                  <a href="<?= ADMIN_URL ?>videos-edit?id=<?= $r['id']; ?>" class="text-blue-600 hover:underline spa-trigger">Edit</a>
                  <form action="<?= ADMIN_URL ?>videos-aksi" method="POST" class="inline ajax-form" data-action="reload" onsubmit="return confirm('Hapus video ini?')">
                    <input type="hidden" name="hapus" value="<?= $r['id'] ?>"><input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <button type="submit" class="text-red-600 hover:underline bg-transparent border-none p-0 font-bold cursor-pointer">Hapus</button>
                  </form>
                </td>
              </tr>
            <?php endwhile;
          else: ?>
            <tr>
              <td colspan="4" id="no-results-videos" class="text-center text-gray-400 py-10">Belum ada koleksi rekaman video kegiatan.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <?php if ($total_hal > 1) : ?>
      <div class="flex justify-center gap-1 bg-white p-2 rounded-xl border font-bold mt-4 dark:bg-zinc-900 dark:border-zinc-700">
        <?php for ($i = 1; $i <= $total_hal; $i++) : ?>
          <a href="<?= ADMIN_URL ?>videos?p=<?= $i; ?>" class="px-2 py-1 rounded border <?= ($i === $hal) ? 'bg-indigo-600 text-white border-indigo-600' : 'bg-white text-gray-600 hover:bg-gray-50 dark:bg-zinc-800 dark:text-zinc-300 dark:border-zinc-700 dark:hover:bg-zinc-700' ?>"><?= $i; ?></a>
        <?php endfor; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
<?php include 'footer.php'; ?>
<script>
  // Initialize live search for this page
  document.addEventListener('DOMContentLoaded', () => {
    initLiveSearch('live-search-videos', 'table-videos-body', 'no-results-videos');
  });
</script>