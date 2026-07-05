<!-- SECTION: 2 VIDEO TERBARU (VERSI EMBED UTUH - DIJAMIN SUKSES) -->
<section class="container mx-auto px-6 py-12 border-t border-gray-100 dark:border-zinc-800">
  <div class="text-center max-w-xl mx-auto mb-10">
    <h2
      class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cerita to-amber-500 dark:from-cerita dark:to-amber-300"
      style="--tw-gradient-from: <?= HERO_GRADIENT_START ?>; --tw-gradient-to: <?= HERO_GRADIENT_END ?>; background-image: linear-gradient(to right, var(--tw-gradient-from), var(--tw-gradient-to));">🎬 <?= htmlspecialchars(VIDEO_SECTION_TITLE); ?></h2>
    <p class="text-gray-500 dark:text-gray-400 text-sm mt-1"><?= htmlspecialchars(VIDEO_SECTION_SUBTITLE); ?></p>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <?php if (mysqli_num_rows($video_res) > 0) : while ($v = mysqli_fetch_assoc($video_res)): ?>
        <div class="bg-white dark:bg-zinc-800 p-4 rounded-2xl border border-gray-100 dark:border-zinc-700 shadow-sm flex flex-col justify-between transition duration-300">

          <!-- BINGKAI KOTAK MULTIMEDIA -->
          <div class="aspect-video w-full rounded-xl overflow-hidden bg-black shadow-inner">

            <?php if ($v['tipe_sumber'] === 'youtube') : ?>
              <!-- PERBAIKAN TOTAL: Langsung mencetak link embed utuh tanpa manipulasi Regex / JS string -->
              <iframe
                class="w-full h-full"
                src="<?= htmlspecialchars($v['tautan_video']); ?>"
                title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin"
                allowfullscreen>
              </iframe>
            <?php else: ?>
              <!-- Opsi Video Unggahan Lokal (.mp4 murni) -->
              <video controls class="w-full h-full object-cover" preload="metadata">
                <source src="<?= BASE_URL; ?>uploads/videos/<?= htmlspecialchars($v['tautan_video']); ?>" type="video/mp4">
                Browser Anda tidak mendukung tag video HTML5.
              </video>
            <?php endif; ?>

          </div>
          <h3 class="text-base font-bold text-tulisan dark:text-zinc-100 mt-4 px-1 line-clamp-2"><?= htmlspecialchars($v['judul_video']); ?></h3>
        </div>
      <?php endwhile;
    else: ?>
      <p class="col-span-full text-center text-gray-400 py-6 text-sm">Belum ada video dokumentasi kegiatan terbaru.</p>
    <?php endif; ?>
  </div>
</section>