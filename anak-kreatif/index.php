<?php
require_once 'config/database.php';

// Lacak kunjungan ke halaman Beranda
track_page_visit($conn, 'beranda');

include 'header.php';

// AMBIL DATA SLIDER BACKGROUND AKTIF
$slider_res = mysqli_query($conn, "SELECT gambar FROM sliders WHERE is_active = 1 ORDER BY id DESC");
$sliders = [];
while ($row = mysqli_fetch_assoc($slider_res)) {
  $sliders[] = (!filter_var($row['gambar'], FILTER_VALIDATE_URL) && file_exists('uploads/' . $row['gambar'])) ? 'uploads/' . $row['gambar'] : $row['gambar'];
}
if (empty($sliders)) {
  $sliders = ['https://unsplash.com'];
}

// AMBIL 2 DATA VIDEO KEGIATAN TERBARU
$video_limit = HOME_VIDEO_LIMIT;
$video_res = mysqli_query($conn, "SELECT * FROM videos WHERE is_active = 1 ORDER BY id DESC LIMIT $video_limit");


// ==========================================
// RENDERING POTONGAN KOMPONEN MODULAR
// ==========================================
?>

<!-- Wrapper <main> ditambahkan agar kompatibel dengan navigasi SPA -->
<main class="flex-grow">
  <?php include 'components/hero.php'; ?>
  <?php include 'components/features.php'; ?>
  <?php include 'components/videos.php'; ?>
  <!-- ENGINE SLIDER AUTOMATIC CROSSFADE (dipindahkan ke dalam <main>) -->
  <script>
    function initHomepageSlider() {
      const gambarSliders = <?= json_encode($sliders); ?>;
      const wrapper = document.getElementById('slider-bg-wrapper');
      const btnPrev = document.getElementById('slide-prev'),
        btnNext = document.getElementById('slide-next');
      const dots = document.querySelectorAll('.dot-item');

      if (wrapper && gambarSliders.length > 0 && wrapper.children.length === 0) { // Cek agar tidak diinisialisasi ulang
        gambarSliders.forEach((url, indeks) => {
          const divGambar = document.createElement('div');
          divGambar.className = `absolute inset-0 bg-cover bg-center transition-opacity duration-1000 ease-in-out ${indeks === 0 ? 'opacity-100' : 'opacity-0'}`;
          divGambar.style.backgroundImage = `url('${url}')`;
          wrapper.appendChild(divGambar);
        });

        let indeksAktif = 0;
        const elemenSlides = wrapper.children;
        let timerAuto;

        function ubahSlide(indeksBaru) {
          if (elemenSlides.length <= 1) return;
          elemenSlides[indeksAktif].classList.replace('opacity-100', 'opacity-0');
          if (dots.length > 0) dots[indeksAktif].classList.replace('bg-white', 'bg-white/40');
          indeksAktif = indeksBaru;
          elemenSlides[indeksAktif].classList.replace('opacity-0', 'opacity-100');
          if (dots.length > 0) dots[indeksAktif].classList.replace('bg-white/40', 'bg-white');
        }

        if (dots.length > 0) dots[0].classList.replace('bg-white/40', 'bg-white');

        function jalankanOtomatis() {
          timerAuto = setInterval(() => {
            ubahSlide((indeksAktif + 1) % elemenSlides.length);
          }, 5000);
        }

        function resetTimerOtomatis() {
          clearInterval(timerAuto);
          jalankanOtomatis();
        }

        if (btnNext) {
          btnNext.addEventListener('click', () => {
            ubahSlide((indeksAktif + 1) % elemenSlides.length);
            resetTimerOtomatis();
          });
        }
        if (btnPrev) {
          btnPrev.addEventListener('click', () => {
            ubahSlide((indeksAktif - 1 + elemenSlides.length) % elemenSlides.length);
            resetTimerOtomatis();
          });
        }
        dots.forEach(dot => {
          dot.addEventListener('click', (e) => {
            ubahSlide(parseInt(e.target.getAttribute('data-index')));
            resetTimerOtomatis();
          });
        });
        jalankanOtomatis();
      }
    }
    // Panggil fungsi inisialisasi untuk load halaman pertama kali
    initHomepageSlider();
  </script>
</main>

<?php
include 'footer.php';
?>