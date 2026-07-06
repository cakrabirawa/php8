<?php
require_once '../config/database.php';
if (!isset($_SESSION['login_admin'])) {
  header("Location: " . ADMIN_URL . "login");
  exit;
}

// Paging Sektor Kelas
$limit_k = ADMIN_PAGING;
$hal_k = isset($_GET['p']) ? (int)$_GET['p'] : 1;
if ($hal_k < 1) $hal_k = 1;
$offset_k = ($hal_k - 1) * $limit_k;

$stmt_total = $conn->query("SELECT COUNT(*) AS total FROM kelas_menulis");
$total_kelas = $stmt_total->fetchColumn() ?? 0;

$total_hal_k = ceil($total_kelas / $limit_k);
$query = "SELECT * FROM kelas_menulis ORDER BY id DESC LIMIT :limit OFFSET :offset";
$stmt_kelas = $conn->prepare($query);
$stmt_kelas->bindValue(':limit', $limit_k, PDO::PARAM_INT);
$stmt_kelas->bindValue(':offset', $offset_k, PDO::PARAM_INT);
$stmt_kelas->execute();
?>
<?php include 'header.php'; ?>

<div class="w-full">
  <div class="mb-6">
    <h1 class="text-2xl font-black text-gray-800 dark:text-zinc-100">✍️ Manajemen Program Kelas</h1>
    <p class="text-gray-500 mt-1 dark:text-zinc-400">Kelola jadwal dan pendaftaran kelas bimbingan menulis.</p>
  </div>

  <div class="flex flex-col justify-between">
    <div class="flex justify-between items-center mb-4">
      <div class="flex-grow">
        <input type="text" id="live-search-kelas" placeholder="Cari kelas berdasarkan nama, mentor, dll..." class="w-full max-w-sm p-2 border rounded-lg dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>
      <a href="<?= ADMIN_URL ?>kelas-tambah" class="spa-trigger bg-teal-500 text-white font-bold py-2 px-4 rounded-md shadow-sm hover:bg-teal-600 transition flex-shrink-0">➕ Tambah Kelas Baru</a>
    </div>

    <div class="bg-white p-4 rounded-xl shadow-sm overflow-x-auto mb-4 border dark:bg-zinc-900 dark:border-zinc-700">
      <table class="w-full text-left">
        <thead>
          <tr class="border-b text-gray-400 font-bold">
            <th class="p-2">Nama Program</th>
            <th class="p-2">Mentor</th>
            <th class="p-2">Jadwal</th>
            <th class="p-2">Harga</th>
            <th class="p-2">Kuota</th>
            <th class="p-2 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody id="table-kelas-body">
          <?php if ($stmt_kelas->rowCount() > 0) : foreach ($stmt_kelas as $r): ?>
              <tr class="border-b hover:bg-gray-50 dark:border-zinc-700 dark:hover:bg-zinc-800">
                <td class="p-2 font-medium"><?= htmlspecialchars($r['nama_kelas']); ?></td>
                <td class="p-2"><?= htmlspecialchars($r['mentor']); ?></td>
                <td class="p-2"><?= htmlspecialchars($r['jadwal']); ?></td>
                <td class="p-2">Rp <?= number_format($r['harga_kelas'], 0, ',', '.'); ?></td>
                <td class="p-2"><?= $r['kuota']; ?> anak</td>
                <td class="p-2 text-center space-x-2 whitespace-nowrap font-bold">
                  <form action="<?= ADMIN_URL ?>kelas-aksi" method="POST" class="inline ajax-form" data-action="reload" onsubmit="return confirm('Duplikat kelas ini?')">
                    <input type="hidden" name="duplikat" value="<?= $r['id'] ?>"><input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <button type="submit" class="text-amber-600 hover:underline bg-transparent border-none p-0 font-bold cursor-pointer">Salin</button>
                  </form>
                  <a href="<?= ADMIN_URL ?>kelas-edit?id=<?= $r['id']; ?>" class="text-blue-600 hover:underline spa-trigger">Edit</a>
                  <form action="<?= ADMIN_URL ?>kelas-aksi" method="POST" class="inline ajax-form" data-action="reload" onsubmit="return confirm('Hapus program kelas ini?')">
                    <input type="hidden" name="hapus" value="<?= $r['id'] ?>"><input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <button type="submit" class="text-red-600 hover:underline bg-transparent border-none p-0 font-bold cursor-pointer">Hapus</button>
                  </form>
                </td>
              </tr>
            <?php endforeach;
          else: ?>
            <tr>
              <td colspan="6" id="no-results-kelas" class="text-center text-gray-400 py-10">Belum ada data program kelas.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <?php if ($total_hal_k > 1) : ?>
      <div class="flex justify-center gap-1 bg-white p-2 rounded-xl border font-bold dark:bg-zinc-900 dark:border-zinc-700">
        <?php for ($i = 1; $i <= $total_hal_k; $i++) : ?>
          <a href="<?= ADMIN_URL ?>kelas?p=<?= $i; ?>" class="px-3 py-1 rounded border <?= ($i === $hal_k) ? 'bg-teal-500 text-white border-teal-500' : 'bg-white text-gray-600 hover:bg-gray-50 dark:bg-zinc-800 dark:text-zinc-300 dark:border-zinc-700 dark:hover:bg-zinc-700' ?>"><?= $i; ?></a>
        <?php endfor; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
<?php include 'footer.php'; ?>
<script>
  // Initialize live search for this page
  document.addEventListener('DOMContentLoaded', () => {
    initLiveSearch('live-search-kelas', 'table-kelas-body', 'no-results-kelas');
  });
</script>