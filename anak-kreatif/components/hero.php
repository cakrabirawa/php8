<!-- Komponen Hero Section (Bagian Paling Atas) -->
<section id="hero" class="relative text-center px-6 overflow-hidden min-h-[50vh] md:min-h-[75vh] flex items-center justify-center">
  <!-- Latar Belakang Slider Otomatis -->
  <div id="slider-bg-wrapper" class="absolute inset-0">
    <!-- Gambar-gambar slider akan dimasukkan di sini oleh JavaScript -->
  </div>
  <!-- Overlay Gelap untuk Kontras Teks -->
  <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-black/30"></div>

  <!-- Konten Teks di Atas Latar Belakang -->
  <div class="relative z-10 max-w-3xl mx-auto">
    <h1
      class="text-4xl md:text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r mb-4 leading-tight"
      style="--tw-gradient-from: <?= HERO_GRADIENT_START ?>; --tw-gradient-to: <?= HERO_GRADIENT_END ?>; background-image: linear-gradient(to right, var(--tw-gradient-from), var(--tw-gradient-to));">
      <?= htmlspecialchars(HERO_TITLE); ?>
    </h1>
    <p class="text-white/80 text-base md:text-lg max-w-2xl mx-auto mb-8">
      <?= htmlspecialchars(HERO_SUBTITLE); ?>
    </p>
    <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
      <a href="<?= BASE_URL ?>toko" class="w-full sm:w-auto bg-cerita text-white font-bold py-3 px-8 rounded-full shadow-lg hover:bg-opacity-90 transition transform hover:scale-105">Lihat Katalog Buku</a>
      <a href="<?= BASE_URL ?>kelas" class="w-full sm:w-auto bg-white/20 backdrop-blur-sm text-white font-bold py-3 px-8 rounded-full border border-white/30 hover:bg-white/30 transition">Jadwal Kelas Menulis</a>
    </div>
  </div>
</section>