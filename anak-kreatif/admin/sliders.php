<?php
require_once '../config/database.php';
if (!isset($_SESSION['login_admin'])) {
  header("Location: " . ADMIN_URL . "login");
  exit;
}

// Konfigurasi Paging Slider
/*  */
$batas = ADMIN_PAGING;
$halaman = isset($_GET['p']) ? (int)$_GET['p'] : 1;
if ($halaman < 1) {
  $halaman = 1;
}
$offset = ($halaman - 1) * $batas;

$stmt_total = $conn->query("SELECT COUNT(*) AS total FROM sliders");
$total_slider = $stmt_total->fetchColumn() ?? 0;
$total_hal = ceil($total_slider / $batas);

$query = "SELECT * FROM sliders ORDER BY id DESC LIMIT :limit OFFSET :offset";
$stmt = $conn->prepare($query);
$stmt->bindValue(':limit', $batas, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
?>
<?php include 'header.php'; ?>

<div class="w-full">
  <div class="mb-6">
    <h1 class="text-2xl font-black text-gray-800 dark:text-zinc-100">🖼️ Manajemen Slider Halaman Utama</h1>
    <p class="text-gray-500 mt-1 dark:text-zinc-400">Atur koleksi gambar latar belakang transisi pada beranda depan.</p>
  </div>

  <div class="flex flex-col justify-between">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-bold text-amber-600 dark:text-amber-500">Daftar Slider</h2>
      <a href="<?= ADMIN_URL ?>sliders-tambah" class="spa-trigger bg-amber-500 text-white font-bold py-2 px-4 rounded-md shadow-sm hover:bg-amber-600 transition">➕ Tambah Slider Baru</a>
    </div>

    <div class="bg-white p-4 rounded-xl shadow-sm border mb-4 dark:bg-zinc-900 dark:border-zinc-700">
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
        <?php if ($stmt->rowCount() > 0) : foreach ($stmt as $r):
            $img = (filter_var($r['gambar'], FILTER_VALIDATE_URL)) ? $r['gambar'] : '../uploads/' . $r['gambar'];
            $status_aktif = (int)$r['is_active'] === 1;
        ?>
            <div class="border rounded-xl overflow-hidden bg-gray-50 flex flex-col justify-between shadow-sm <?= !$status_aktif ? 'opacity-60' : '' ?> dark:bg-zinc-800 dark:border-zinc-700">
              <div class="h-28 overflow-hidden bg-gray-200 relative dark:bg-zinc-700">
                <img src="<?= htmlspecialchars($img); ?>" class="w-full h-full object-cover">
                <!-- INDIKATOR STATUS VISUAL -->
                <span class="absolute top-2 left-2 text-[9px] font-bold px-2 py-0.5 rounded-full shadow-sm <?= $status_aktif ? 'bg-emerald-500 text-white' : 'bg-gray-500 text-white' ?>">
                  <?= $status_aktif ? '● Aktif' : '○ Nonaktif' ?>
                </span>
              </div>
              <div class="p-3 bg-white border-t dark:bg-zinc-800/50 dark:border-zinc-700">
                <p class="font-bold truncate mb-2 text-gray-700"><?= !empty($r['judul_slider']) ? htmlspecialchars($r['judul_slider']) : 'Tanpa Judul'; ?></p>
                <div class="flex justify-between items-center">
                  <!-- TOMBOL TOGGLE STATUS CEPAT (via POST) -->
                  <form action="<?= ADMIN_URL ?>sliders-aksi" method="POST" class="inline ajax-form" data-action="reload">
                    <?= csrf_token_input(); ?>
                    <input type="hidden" name="toggle_status" value="<?= $r['id']; ?>">
                    <input type="hidden" name="status" value="<?= $r['is_active']; ?>">
                    <button type="submit" class="font-bold text-[10px] bg-transparent border-none cursor-pointer p-0 <?= $status_aktif ? 'text-amber-600 hover:text-amber-700' : 'text-emerald-600 hover:text-emerald-700' ?>"><?= $status_aktif ? 'Sembunyikan' : 'Tampilkan' ?></button>
                  </form>
                  <div class="flex gap-1.5 font-bold text-[10px]">
                    <a href="<?= ADMIN_URL ?>sliders-edit?id=<?= $r['id']; ?>" class="bg-blue-50 text-blue-600 px-2.5 py-1 rounded hover:bg-blue-100 spa-trigger">Ubah</a>
                    <form action="<?= ADMIN_URL ?>sliders-aksi" method="POST" class="inline ajax-form" data-action="reload" onsubmit="return confirm('Hapus gambar background ini?')">
                      <input type="hidden" name="hapus" value="<?= $r['id'] ?>"><input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                      <button type="submit" class="bg-red-50 text-red-600 px-2.5 py-1 rounded hover:bg-red-100 font-bold text-[10px] cursor-pointer">Hapus</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach;
        else: ?>
          <p class="text-gray-400 text-center py-10 col-span-full">Belum ada gambar latar belakang slider di halaman ini.</p>
        <?php endif; ?>
      </div>
    </div>

    <!-- Elemen Tombol Navigasi Paging Slider -->
    <?php if ($total_hal > 1) : ?>
      <div class="flex justify-center items-center gap-1 bg-white p-2 rounded-xl border font-bold dark:bg-zinc-900 dark:border-zinc-700">
        <?php if ($halaman > 1) : ?>
          <a href="<?= ADMIN_URL ?>sliders?p=<?= $halaman - 1; ?>" class="px-2.5 py-1 border rounded bg-white text-gray-600 hover:bg-gray-50 dark:bg-zinc-800 dark:text-zinc-300 dark:border-zinc-700 dark:hover:bg-zinc-700">←</a>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $total_hal; $i++) : ?>
          <a href="<?= ADMIN_URL ?>sliders?p=<?= $i; ?>" class="px-2.5 py-1 rounded border <?= ($i === $halaman) ? 'bg-amber-500 text-white border-amber-500' : 'bg-white text-gray-600 hover:bg-gray-50 dark:bg-zinc-800 dark:text-zinc-300 dark:border-zinc-700 dark:hover:bg-zinc-700' ?>">
            <?= $i; ?>
          </a>
        <?php endfor; ?>
        <?php if ($halaman < $total_hal) : ?>
          <a href="<?= ADMIN_URL ?>sliders?p=<?= $halaman + 1; ?>" class="px-2.5 py-1 border rounded bg-white text-gray-600 hover:bg-gray-50 dark:bg-zinc-800 dark:text-zinc-300 dark:border-zinc-700 dark:hover:bg-zinc-700">→</a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
<?php include 'footer.php'; ?>