<?php
require_once '../config/database.php';
if (!isset($_SESSION['login_admin'])) {
  header("Location: " . ADMIN_URL . "login");
  exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$res = mysqli_query($conn, "SELECT * FROM videos WHERE id=$id");
if (mysqli_num_rows($res) === 0) {
  header("Location: " . ADMIN_URL . "videos");
  exit;
}
$v = mysqli_fetch_assoc($res);
?>
<?php include 'header.php'; ?>

<div class="w-full">
  <div class="mb-6">
    <h1 class="text-2xl font-black text-gray-800 dark:text-zinc-100">📝 Edit Dokumentasi Video</h1>
    <p class="text-gray-500 mt-1 dark:text-zinc-400">Mengubah tautan atau berkas video dokumentasi.</p>
  </div>

  <!-- Video Preview Section -->
  <div class="mb-6 bg-black rounded-xl overflow-hidden aspect-video relative shadow-lg border dark:border-zinc-700">
    <?php if ($v['tipe_sumber'] === 'youtube' && !empty($v['tautan_video'])) : ?>
      <iframe class="absolute inset-0 w-full h-full" src="<?= htmlspecialchars($v['tautan_video']) ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    <?php elseif ($v['tipe_sumber'] === 'upload' && !empty($v['tautan_video']) && file_exists('../uploads/videos/' . $v['tautan_video'])) : ?>
      <video class="w-full h-full object-contain bg-black" controls>
        <source src="../uploads/videos/<?= htmlspecialchars($v['tautan_video']) ?>" type="video/mp4">
        Browser Anda tidak mendukung tag video.
      </video>
    <?php else : ?>
      <div class="w-full h-full bg-gray-200 dark:bg-zinc-800 flex items-center justify-center">
        <p class="text-gray-500 font-semibold">🎬 Pratinjau tidak tersedia</p>
      </div>
    <?php endif; ?>
  </div>

  <div class="bg-white p-6 rounded-2xl shadow-sm border w-full dark:bg-zinc-900 dark:border-zinc-700">
    <form action="<?= ADMIN_URL ?>videos-aksi" method="POST" enctype="multipart/form-data" class="space-y-4 ajax-form" data-redirect-url="<?= ADMIN_URL ?>videos">
      <?= csrf_token_input(); ?>
      <input type="hidden" name="action_type" value="update">
      <input type="hidden" name="id" value="<?= $v['id']; ?>">
      <input type="hidden" name="tautan_lama" value="<?= $v['tautan_video']; ?>">
      <input type="hidden" name="tipe_lama" value="<?= $v['tipe_sumber']; ?>">

      <div>
        <label class="block font-medium mb-1 dark:text-zinc-200">Judul Video</label>
        <input type="text" name="judul_video" value="<?= htmlspecialchars($v['judul_video']); ?>" required class="w-full p-2 border rounded-md text-xs dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>
      <div>
        <label class="block font-medium mb-1 dark:text-zinc-200">Sumber Media Baru</label>
        <select name="tipe_sumber" required class="w-full p-2 border rounded-md bg-white text-xs dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
          <option value="youtube" <?= $v['tipe_sumber'] === 'youtube' ? 'selected' : '' ?>>Tautan Link YouTube</option>
          <option value="upload" <?= $v['tipe_sumber'] === 'upload' ? 'selected' : '' ?>>Unggah Berkas File (.mp4 lokal)</option>
        </select>
      </div>
      <div class="bg-gray-50 p-3 rounded-lg border space-y-3 dark:bg-zinc-800/50 dark:border-zinc-700">
        <div>
          <label class="block text-[10px] font-bold text-gray-400 mb-1 dark:text-zinc-400">Opsi A: Perbarui URL YouTube</label>
          <input type="url" name="tautan_youtube" value="<?= $v['tipe_sumber'] === 'youtube' ? htmlspecialchars($v['tautan_video']) : '' ?>" class="w-full p-2 border bg-white rounded text-[10px] dark:bg-zinc-700 dark:border-zinc-600">
        </div>
        <div class="text-center text-[10px] font-black text-gray-300">ATAU</div>
        <div>
          <label class="block text-[10px] font-bold text-gray-400 mb-1 dark:text-zinc-400">Opsi B: Ganti File Video Baru (.mp4)</label>
          <input type="file" name="video_upload" accept="video/mp4" class="w-full p-1 border bg-white rounded text-[10px] dark:bg-zinc-700 dark:border-zinc-600">
        </div>
      </div>
      <div class="flex gap-2 pt-2 font-semibold">
        <button type="submit" class="flex-grow bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 text-xs">Simpan</button>
        <a href="<?= ADMIN_URL ?>videos" class="spa-trigger bg-gray-200 text-gray-700 py-2 px-4 rounded-md text-center hover:bg-gray-300 dark:bg-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-600">Batal</a>
      </div>
    </form>
  </div>
</div>
<?php include 'footer.php'; ?>