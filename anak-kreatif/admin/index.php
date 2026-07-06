<?php
require_once '../config/database.php';

if (!isset($_SESSION['login_admin'])) {
  header("Location: " . ADMIN_URL . "login");
  exit;
}

// Optimasi: Ambil semua statistik dalam satu query
$stats_query = "
    SELECT
        (SELECT COUNT(*) FROM produk_buku) AS total_buku,
        (SELECT COUNT(*) FROM kelas_menulis) AS total_kelas,
        (SELECT COUNT(*) FROM kategori_produk) AS total_kategori,
        (SELECT COUNT(*) FROM videos) AS total_video
";
$stmt_stats = $conn->query($stats_query);
$stats = $stmt_stats ? $stmt_stats->fetch() : ['total_buku' => 0, 'total_kelas' => 0, 'total_kategori' => 0, 'total_video' => 0];

// Ambil statistik pengunjung
$visitor_stats_query = "
    SELECT
        (SELECT COUNT(*) FROM access_logs WHERE DATE(access_timestamp) = CURDATE()) AS today,
        (SELECT COUNT(*) FROM access_logs WHERE YEAR(access_timestamp) = YEAR(CURDATE()) AND MONTH(access_timestamp) = MONTH(CURDATE())) AS this_month,
        (SELECT COUNT(*) FROM access_logs WHERE YEAR(access_timestamp) = YEAR(CURDATE())) AS this_year
";
$stmt_visitor = $conn->query($visitor_stats_query);
$visitor_stats = $stmt_visitor ? $stmt_visitor->fetch() : ['today' => 0, 'this_month' => 0, 'this_year' => 0];

// Ambil 5 negara teratas
$top_countries_query = "SELECT country_code, COUNT(*) as visits FROM access_logs WHERE country_code IS NOT NULL GROUP BY country_code ORDER BY visits DESC LIMIT 5";
$top_countries_stmt = $conn->query($top_countries_query);

// Data untuk grafik pengunjung 7 hari terakhir
$chart_labels = [];
$chart_data = [];
$date_range = [];

// Buat rentang 7 hari terakhir
for ($i = 6; $i >= 0; $i--) {
  $date = date('Y-m-d', strtotime("-$i days"));
  $date_range[$date] = 0; // Inisialisasi dengan 0 kunjungan
  $chart_labels[] = date('d M', strtotime($date)); // Format untuk label grafik
}

// Ambil data dari DB
$chart_query = "
    SELECT DATE(access_timestamp) as visit_date, COUNT(*) as visit_count
    FROM access_logs
    WHERE access_timestamp >= CURDATE() - INTERVAL 6 DAY
    GROUP BY visit_date
";
$chart_stmt = $conn->query($chart_query);
if ($chart_stmt) {
  // Use a while loop to iterate over the results
  while ($row = $chart_stmt->fetch()) {
    if (isset($date_range[$row['visit_date']])) $date_range[$row['visit_date']] = (int)$row['visit_count'];
  }
}
$chart_data = array_values($date_range);
?>
<?php include 'header.php'; ?>

<div class="w-full">
  <div class="mb-6">
    <h1 class="text-2xl font-black text-gray-800 dark:text-zinc-100">👋 Halo, <?= htmlspecialchars($_SESSION['admin_name']); ?>!</h1>
    <p class="text-gray-500 mt-1 dark:text-zinc-400">Ringkasan data dan aktivitas di website AnakKreatif.</p>
  </div>

  <!-- Dashboard Widgets Area -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-white p-6 rounded-xl shadow-sm border flex items-center gap-4 dark:bg-zinc-900 dark:border-zinc-700">
      <div class="text-4xl">📚</div>
      <div>
        <p class="text-gray-500 font-bold text-[10px] uppercase tracking-wider dark:text-zinc-400">Total Buku</p>
        <p class="text-2xl font-black text-orange-600"><?= $stats['total_buku']; ?></p>
      </div>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-sm border flex items-center gap-4 dark:bg-zinc-900 dark:border-zinc-700">
      <div class="text-4xl">✍️</div>
      <div>
        <p class="text-gray-500 font-bold text-[10px] uppercase tracking-wider dark:text-zinc-400">Program Kelas</p>
        <p class="text-2xl font-black text-teal-600"><?= $stats['total_kelas']; ?></p>
      </div>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-sm border flex items-center gap-4 dark:bg-zinc-900 dark:border-zinc-700">
      <div class="text-4xl">📁</div>
      <div>
        <p class="text-gray-500 font-bold text-[10px] uppercase tracking-wider dark:text-zinc-400">Kategori Valid</p>
        <p class="text-2xl font-black text-green-600"><?= $stats['total_kategori']; ?></p>
      </div>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-sm border flex items-center gap-4 dark:bg-zinc-900 dark:border-zinc-700">
      <div class="text-4xl">🎬</div>
      <div>
        <p class="text-gray-500 font-bold text-[10px] uppercase tracking-wider dark:text-zinc-400">Koleksi Video</p>
        <p class="text-2xl font-black text-indigo-600"><?= $stats['total_video']; ?></p>
      </div>
    </div>
  </div>

  <!-- Visitor Statistics -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-white p-6 rounded-xl shadow-sm border dark:bg-zinc-900 dark:border-zinc-700">
      <h3 class="text-lg font-bold text-gray-700 dark:text-zinc-200 mb-4">📈 Statistik Pengunjung</h3>
      <div class="grid grid-cols-3 gap-4 text-center">
        <div>
          <p class="text-2xl font-black text-sky-600"><?= $visitor_stats['today']; ?></p>
          <p class="text-[10px] font-bold text-gray-500 dark:text-zinc-400 uppercase">Hari Ini</p>
        </div>
        <div>
          <p class="text-2xl font-black text-sky-600"><?= $visitor_stats['this_month']; ?></p>
          <p class="text-[10px] font-bold text-gray-500 dark:text-zinc-400 uppercase">Bulan Ini</p>
        </div>
        <div>
          <p class="text-2xl font-black text-sky-600"><?= $visitor_stats['this_year']; ?></p>
          <p class="text-[10px] font-bold text-gray-500 dark:text-zinc-400 uppercase">Tahun Ini</p>
        </div>
      </div>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-sm border dark:bg-zinc-900 dark:border-zinc-700">
      <h3 class="text-lg font-bold text-gray-700 dark:text-zinc-200 mb-4">🌍 Negara Pengunjung Teratas</h3>
      <ul class="space-y-2 text-sm">
        <?php if ($top_countries_stmt && $top_countries_stmt->rowCount() > 0): foreach ($top_countries_stmt as $country): ?>
            <li class="flex justify-between items-center font-medium">
              <span class="flex items-center gap-2 text-gray-600 dark:text-zinc-300">
                <?= get_flag_icon($country['country_code']); ?>
                <span><?= htmlspecialchars($country['country_code']); ?></span>
              </span>
              <span class="font-bold text-gray-800 dark:text-zinc-100"><?= number_format($country['visits']); ?> Kunjungan</span>
            </li>
          <?php endforeach;
        else: ?>
          <p class="text-gray-400 text-center py-2">Belum ada data pengunjung.</p>
        <?php endif; ?>
      </ul>
    </div>
  </div>

  <!-- Visitor Chart -->
  <div class="bg-white p-6 rounded-xl shadow-sm border dark:bg-zinc-900 dark:border-zinc-700 mb-6">
    <h3 class="text-lg font-bold text-gray-700 dark:text-zinc-200 mb-4">📊 Grafik Kunjungan 7 Hari Terakhir</h3>
    <!-- Data container for the chart script -->
    <div id="chart-data-container" data-labels='<?= json_encode($chart_labels); ?>' data-data='<?= json_encode($chart_data); ?>'></div>
    <div class="chart-container">
      <canvas id="visitorChart"></canvas>
    </div>
  </div>

  <div class="bg-blue-50 text-blue-700 p-6 rounded-xl border border-blue-100 text-sm dark:bg-blue-500/10 dark:text-blue-300 dark:border-blue-500/20">
    <h2 class="font-bold text-base mb-2 dark:text-blue-200">👋 Selamat Datang di Pusat Manajemen!</h2>
    <p class="dark:text-blue-300/80">Silakan gunakan menu navigasi di atas untuk mengelola seluruh konten pada website AnakKreatif. Pengelolaan <b>Katalog Buku</b> dan <b>Program Kelas</b> kini telah dipisahkan ke halamannya masing-masing secara eksklusif untuk memberikan keleluasaan dalam mengontrol data Anda.</p>
  </div>

</div>
<?php include 'footer.php'; ?>