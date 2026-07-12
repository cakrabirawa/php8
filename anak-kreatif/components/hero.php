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
    <!-- PERUBAHAN: ID ditambahkan untuk target JS, dan konten dikosongkan -->
    <h1
      id="hero-typing-text"
      class="text-4xl md:text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r mb-4 leading-tight min-h-[100px] md:min-h-[190px]"
      style="--tw-gradient-from: <?= HERO_GRADIENT_START ?>; --tw-gradient-to: <?= HERO_GRADIENT_END ?>; background-image: linear-gradient(to right, var(--tw-gradient-from), var(--tw-gradient-to));">
      <!-- Teks akan diketik di sini oleh JavaScript -->
      <span class="typing-text"></span><span class="typing-cursor"></span>
    </h1>
    <p class="text-white/80 text-base md:text-lg max-w-2xl mx-auto mb-8">
      <?= htmlspecialchars(HERO_SUBTITLE); ?>
    </p>
    <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
      <a href="<?= BASE_URL ?>toko" class="w-full sm:w-auto bg-cerita text-white font-bold py-3 px-8 rounded-full shadow-lg hover:bg-opacity-90 transition transform hover:scale-105">Lihat Katalog Buku</a>
      <a href="<?= BASE_URL ?>kelas" class="w-full sm:w-auto bg-white/20 backdrop-blur-sm text-white font-bold py-3 px-8 rounded-full border border-white/30 hover:bg-white/30 transition">Jadwal Kelas Menulis</a>
    </div>
  </div>

  <!-- Tombol Navigasi Panah Slider -->
  <button id="slide-prev" class="absolute top-1/2 left-4 z-20 -translate-y-1/2 p-2 rounded-full bg-white/20 text-white hover:bg-white/40 transition">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
    </svg>
  </button>
  <button id="slide-next" class="absolute top-1/2 right-4 z-20 -translate-y-1/2 p-2 rounded-full bg-white/20 text-white hover:bg-white/40 transition">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
    </svg>
  </button>

  <!-- Indikator Titik (Dots) Slider -->
  <div class="absolute bottom-8 left-1/2 z-20 -translate-x-1/2 flex space-x-2">
    <?php foreach ($sliders as $index => $slider) : ?>
      <button class="dot-item w-3 h-3 rounded-full bg-white/40 hover:bg-white/70 transition" data-index="<?= $index ?>"></button>
    <?php endforeach; ?>
  </div>
</section>