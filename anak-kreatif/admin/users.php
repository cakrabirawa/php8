<?php
require_once '../config/database.php';
if (!isset($_SESSION['login_admin'])) {
  header("Location: " . ADMIN_URL . "login");
  exit;
}

// Paging Pengelola
$limit = ADMIN_PAGING;
$hal = isset($_GET['p']) ? (int)$_GET['p'] : 1;
if ($hal < 1) {
  $hal = 1;
}
$offset = ($hal - 1) * $limit;
$total_res = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users_admin"));
$total_hal = ceil($total_res['total'] / $limit);

$stmt_users = mysqli_prepare($conn, "SELECT * FROM users_admin ORDER BY id DESC LIMIT ? OFFSET ?");
mysqli_stmt_bind_param($stmt_users, 'ii', $limit, $offset);
mysqli_stmt_execute($stmt_users);
$users_res = mysqli_stmt_get_result($stmt_users);
?>
<?php include 'header.php'; ?>

<div class="w-full">
  <div class="mb-6">
    <h1 class="text-2xl font-black text-gray-800 dark:text-zinc-100">👤 Manajemen User Pengelola</h1>
    <p class="text-gray-500 mt-1 dark:text-zinc-400">Tambah atau perbarui hak akses admin web AnakKreatif.</p>
  </div>

  <div class="flex flex-col justify-between">
    <div class="flex justify-between items-center mb-4">
      <div class="flex-grow">
        <input type="text" id="live-search-users" placeholder="Cari admin..." class="w-full max-w-sm p-2 border rounded-lg dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>
      <a href="<?= ADMIN_URL ?>users-tambah" class="spa-trigger bg-blue-600 text-white font-bold py-2 px-4 rounded-md shadow-sm hover:bg-blue-700 transition flex-shrink-0">➕ Tambah Admin Baru</a>
    </div>

    <div class="bg-white p-4 rounded-xl shadow-sm overflow-x-auto mb-4 border dark:bg-zinc-900 dark:border-zinc-700">
      <table class="w-full text-left">
        <thead>
          <tr class="border-b text-gray-400 font-bold">
            <th class="p-2 w-12"></th>
            <th class="p-2">Username</th>
            <th class="p-2">Nama Lengkap</th>
            <th class="p-2 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody id="table-users-body">
          <?php if (mysqli_num_rows($users_res) > 0): while ($r = mysqli_fetch_assoc($users_res)): ?>
              <tr class="border-b hover:bg-gray-50 dark:border-zinc-700 dark:hover:bg-zinc-800">
                <td class="p-2 w-12">
                  <?php if (!empty($r['avatar']) && file_exists('../uploads/avatars/' . $r['avatar'])): ?>
                    <img src="../uploads/avatars/<?= htmlspecialchars($r['avatar']); ?>" alt="Avatar" class="w-8 h-8 rounded-full object-cover">
                  <?php else: ?>
                    <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-500/20 flex items-center justify-center text-blue-600 dark:text-blue-300 font-bold text-sm">
                      <?= strtoupper(substr($r['nama_lengkap'] ?? 'A', 0, 1)); ?>
                    </div>
                  <?php endif; ?>
                </td>
                <td class="p-2 font-medium"><?= htmlspecialchars($r['username']); ?></td>
                <td class="p-2"><?= htmlspecialchars($r['nama_lengkap']); ?></td>
                <td class="p-2 text-center space-x-2 font-bold whitespace-nowrap">
                  <a href="<?= ADMIN_URL ?>users-edit?id=<?= $r['id']; ?>" class="text-blue-600 hover:underline spa-trigger">Edit</a>

                  <!-- LOGIKA DINAMIS: Tombol Hapus hanya muncul jika username baris ini bukan milik admin yang sedang login -->
                  <?php if ($r['username'] !== ($_SESSION['username_admin'] ?? '')) : ?>
                    <form action="<?= ADMIN_URL ?>users-aksi" method="POST" class="inline ajax-form" data-action="reload" onsubmit="return confirm('Hapus pengguna ini?')">
                      <input type="hidden" name="hapus" value="<?= $r['id'] ?>"><input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                      <button type="submit" class="text-red-600 hover:underline bg-transparent border-none p-0 font-bold cursor-pointer">Hapus</button>
                    </form>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endwhile;
          else: ?>
            <tr>
              <td colspan="4" id="no-results-users" class="text-center text-gray-400 py-10">Belum ada data admin.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <?php if ($total_hal > 1) : ?>
      <div class="flex justify-center gap-1 bg-white p-2 rounded-xl border font-bold dark:bg-zinc-900 dark:border-zinc-700">
        <?php for ($i = 1; $i <= $total_hal; $i++) : ?>
          <a href="<?= ADMIN_URL ?>users?p=<?= $i; ?>" class="px-2 py-1 rounded border <?= ($i === $hal) ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-600 dark:bg-zinc-800 dark:text-zinc-300 dark:border-zinc-700 dark:hover:bg-zinc-700' ?>"><?= $i; ?></a>
        <?php endfor; ?>
      </div>
    <?php endif; ?>

  </div>
</div>
<?php include 'footer.php'; ?>
<script>
  // Initialize live search for this page
  document.addEventListener('DOMContentLoaded', () => {
    initLiveSearch('live-search-users', 'table-users-body', 'no-results-users');
  });
</script>