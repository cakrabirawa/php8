<?php
require_once '../config/database.php';

if (!isset($_SESSION['login_admin'])) {
  header("Location: " . ADMIN_URL . "login");
  exit;
}
?>
<?php include 'header.php'; ?>

<div class="w-full">
  <div class="mb-6">
    <h1 class="text-2xl font-black text-gray-800 dark:text-zinc-100">⚙️ Konfigurasi Sistem</h1>
    <p class="text-gray-500 mt-1 dark:text-zinc-400">Atur preferensi global untuk panel manajemen.</p>
  </div>

  <?php if (!empty($_SESSION['flash_success'])): ?>
    <div class="bg-emerald-50 text-emerald-700 p-3 rounded-xl mb-4 font-bold border border-emerald-100 dark:bg-emerald-500/10 dark:text-emerald-300 dark:border-emerald-500/20"><?= htmlspecialchars($_SESSION['flash_success']); ?></div>
    <?php unset($_SESSION['flash_success']); ?>
  <?php endif; ?>

  <div class="bg-white p-6 rounded-xl shadow-sm border dark:bg-zinc-900 dark:border-zinc-700">
    <form action="<?= ADMIN_URL ?>pengaturan-aksi" method="POST" class="space-y-5 ajax-form" data-action="reload" data-redirect-url="<?= ADMIN_URL ?>pengaturan">
      <?= csrf_token_input(); ?>
      <div>
        <label class="block font-semibold mb-1 text-gray-700 dark:text-zinc-200">Batas Baris Data Tabel (Paging Admin)</label>
        <p class="text-[10px] text-gray-400 mb-3 dark:text-zinc-400">Menentukan seberapa banyak data yang ditampilkan per halamannya di setiap menu kelola sebelum dipotong ke halaman berikutnya.</p>
        <input type="number" name="admin_paging" value="<?= ADMIN_PAGING; ?>" min="1" max="100" required class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-gray-300 outline-none font-bold text-gray-800 dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>

      <div>
        <label class="block font-semibold mb-1 text-gray-700 dark:text-zinc-200">Judul Global Website</label>
        <p class="text-[10px] text-gray-400 mb-3 dark:text-zinc-400">Judul ini akan muncul di pojok kiri atas halaman utama dan panel admin.</p>
        <input type="text" name="site_title" value="<?= htmlspecialchars(SITE_TITLE); ?>" required class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-gray-300 outline-none font-bold text-gray-800 dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>

      <div>
        <label class="block font-semibold mb-1 text-gray-700 dark:text-zinc-200">Jumlah Video di Beranda</label>
        <p class="text-[10px] text-gray-400 mb-3 dark:text-zinc-400">Menentukan jumlah video yang ditampilkan di halaman utama.</p>
        <input type="number" name="home_video_limit" value="<?= HOME_VIDEO_LIMIT; ?>" min="1" max="10" required class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-gray-300 outline-none font-bold text-gray-800 dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>

      <div>
        <label class="block font-semibold mb-1 text-gray-700 dark:text-zinc-200">Teks Footer Halaman Utama</label>
        <p class="text-[10px] text-gray-400 mb-3 dark:text-zinc-400">Teks hak cipta yang akan muncul di bagian paling bawah halaman utama.</p>
        <input type="text" name="footer_text" value="<?= htmlspecialchars(defined('FOOTER_TEXT') ? FOOTER_TEXT : ''); ?>" required class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-gray-300 outline-none font-bold text-gray-800 dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>

      <div>
        <label class="block font-semibold mb-1 text-gray-700 dark:text-zinc-200">Tagline Situs</label>
        <p class="text-[10px] text-gray-400 mb-3 dark:text-zinc-400">Slogan atau deskripsi singkat yang muncul di bawah logo pada footer halaman utama.</p>
        <input type="text" name="site_tagline" value="<?= htmlspecialchars(defined('SITE_TAGLINE') ? SITE_TAGLINE : ''); ?>" required class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-gray-300 outline-none font-bold text-gray-800 dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>

      <div>
        <label class="block font-semibold mb-1 text-gray-700 dark:text-zinc-200">Judul Hero Halaman Utama</label>
        <p class="text-[10px] text-gray-400 mb-3 dark:text-zinc-400">Judul besar yang pertama kali dilihat pengunjung di beranda.</p>
        <input type="text" name="hero_title" value="<?= htmlspecialchars(defined('HERO_TITLE') ? HERO_TITLE : ''); ?>" required class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-gray-300 outline-none font-bold text-gray-800 dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>

      <div>
        <label class="block font-semibold mb-1 text-gray-700 dark:text-zinc-200">Subjudul Hero Halaman Utama</label>
        <p class="text-[10px] text-gray-400 mb-3 dark:text-zinc-400">Deskripsi singkat di bawah judul hero.</p>
        <textarea name="hero_subtitle" required class="w-full p-2.5 border rounded-lg h-20 focus:ring-2 focus:ring-gray-300 outline-none font-bold text-gray-800 dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100"><?= htmlspecialchars(defined('HERO_SUBTITLE') ? HERO_SUBTITLE : ''); ?></textarea>
      </div>

      <div>
        <label class="block font-semibold mb-1 text-gray-700 dark:text-zinc-200">Judul Section Video</label>
        <p class="text-[10px] text-gray-400 mb-3 dark:text-zinc-400">Judul untuk bagian video kegiatan di beranda.</p>
        <input type="text" name="video_section_title" value="<?= htmlspecialchars(defined('VIDEO_SECTION_TITLE') ? VIDEO_SECTION_TITLE : ''); ?>" required class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-gray-300 outline-none font-bold text-gray-800 dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>

      <div>
        <label class="block font-semibold mb-1 text-gray-700 dark:text-zinc-200">Subjudul Section Video</label>
        <p class="text-[10px] text-gray-400 mb-3 dark:text-zinc-400">Deskripsi singkat di bawah judul section video.</p>
        <input type="text" name="video_section_subtitle" value="<?= htmlspecialchars(defined('VIDEO_SECTION_SUBTITLE') ? VIDEO_SECTION_SUBTITLE : ''); ?>" required class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-gray-300 outline-none font-bold text-gray-800 dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>

      <div>
        <label class="block font-semibold mb-1 text-gray-700 dark:text-zinc-200">Warna Gradasi Judul Hero</label>
        <p class="text-[10px] text-gray-400 mb-3 dark:text-zinc-400">Pilih dua warna untuk efek gradasi pada judul utama di beranda.</p>
        <div class="flex items-center gap-4">
          <div class="flex items-center gap-2">
            <label for="hero_gradient_start" class="text-sm font-medium dark:text-zinc-300">Mulai:</label>
            <input type="color" id="hero_gradient_start" name="hero_gradient_start" value="<?= htmlspecialchars(defined('HERO_GRADIENT_START') ? HERO_GRADIENT_START : '#FDE68A'); ?>" class="w-10 h-10 rounded-md border-none cursor-pointer">
          </div>
          <div class="flex items-center gap-2">
            <label for="hero_gradient_end" class="text-sm font-medium dark:text-zinc-300">Selesai:</label>
            <input type="color" id="hero_gradient_end" name="hero_gradient_end" value="<?= htmlspecialchars(defined('HERO_GRADIENT_END') ? HERO_GRADIENT_END : '#FFFFFF'); ?>" class="w-10 h-10 rounded-md border-none cursor-pointer">
          </div>
        </div>
      </div>

      <div>
        <label class="block font-semibold mb-1 text-gray-700 dark:text-zinc-200">Tema Panel Admin</label>
        <p class="text-[10px] text-gray-400 mb-3 dark:text-zinc-400">Pilih skema warna untuk antarmuka panel admin.</p>
        <div class="relative inline-block w-40 h-8">
          <input type="radio" id="theme_light" name="admin_theme" value="light" class="hidden peer" <?= (ADMIN_THEME === 'light') ? 'checked' : ''; ?>>
          <input type="radio" id="theme_dark" name="admin_theme" value="dark" class="hidden peer" <?= (ADMIN_THEME === 'dark') ? 'checked' : ''; ?>>
          <label for="theme_light" class="absolute top-0 left-0 w-1/2 h-full flex items-center justify-center text-sm font-semibold cursor-pointer transition-all duration-300 rounded-lg peer-checked:bg-white peer-checked:shadow peer-checked:text-orange-600 dark:peer-checked:bg-zinc-700 dark:peer-checked:text-white">
            ☀️ Terang
          </label>
          <label for="theme_dark" class="absolute top-0 right-0 w-1/2 h-full flex items-center justify-center text-sm font-semibold cursor-pointer transition-all duration-300 rounded-lg peer-checked:bg-zinc-800 peer-checked:shadow peer-checked:text-white dark:peer-checked:bg-zinc-700">
            🌙 Gelap
          </label>
        </div>
      </div>

      <div class="pt-2">
        <button type="submit" class="bg-gray-800 text-white px-6 py-2.5 rounded-lg font-bold hover:bg-gray-900 transition shadow-sm">Simpan Konfigurasi</button>
      </div>
    </form>
  </div>
</div>

<?php include 'footer.php'; ?>