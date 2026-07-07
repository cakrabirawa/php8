    <!-- Kaki Halaman (Footer Global) -->
    <style>
      /* CSS untuk kursor efek mengetik */
      .typing-cursor {
        display: inline-block;
        width: 3px;
        height: 1em;
        background-color: #FDE68A;
        /* Warna gradien awal */
        margin-left: 4px;
        animation: blink 0.7s infinite;
      }

      @keyframes blink {
        50% {
          opacity: 0;
        }
      }
    </style>
    <footer class="bg-tulisan dark:bg-zinc-900 text-white py-10 mt-16 border-t-4 border-amber-200 dark:border-zinc-700 transition-colors duration-300">
      <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="text-center md:text-left">
          <h4 class="text-xl font-bold text-sekolah mb-1">🎨 <?= htmlspecialchars(SITE_TITLE); ?></h4>
          <p class="text-gray-400 dark:text-gray-500 text-sm max-w-sm"><?= htmlspecialchars(SITE_TAGLINE); ?></p>
        </div>
        <div class="text-xs text-gray-500 font-medium tracking-wide">
          <?= htmlspecialchars(FOOTER_TEXT); ?>
        </div>
      </div>
    </footer>

    <!-- PERBAIKAN KRUSIAL: Menyisipkan BASE_URL agar pemanggilan berkas JS kebal dari eror 404 subfolder SEO -->
    <script src="<?= BASE_URL; ?>assets/js/main.js"></script>

    <!-- Efek Header Transparan & Parallax -->
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        /**
         * =================================================================
         * EFEK MENGETIK UNTUK HERO SECTION
         * =================================================================
         */
        const initTypingEffect = () => {
          const typingElement = document.querySelector('.typing-text');
          const cursorElement = document.querySelector('.typing-cursor');
          if (!typingElement || typingElement.hasAttribute('data-typed')) return;

          const textToType = "Tumbuhkan Imajinasi Si Kecil Lewat Buku, Kata dan Tulisan";
          let i = 0;
          typingElement.setAttribute('data-typed', 'true'); // Tandai sudah pernah jalan

          const typeWriter = () => {
            if (i < textToType.length) {
              typingElement.innerHTML += textToType.charAt(i);
              i++;
              setTimeout(typeWriter, 70); // Kecepatan mengetik
            } else {
              // Sembunyikan kursor setelah selesai
              if (cursorElement) cursorElement.style.display = 'none';
            }
          };

          typeWriter();
        };


        // Fungsi ini akan dipanggil setiap kali halaman dimuat, baik secara normal maupun via SPA
        const initializePageEffects = () => {
          const header = document.getElementById('main-header');
          const heroBg = document.getElementById('slider-bg-wrapper');
          const desktopMenu = document.getElementById('desktop-menu');
          const logoLink = header?.querySelector('a[title]');

          if (!header) return;

          // Cek apakah kita di halaman utama (berdasarkan keberadaan hero)
          const isHomepage = !!heroBg;

          const handleScroll = () => {
            const isScrolled = window.scrollY > 10;

            // Saat di-scroll, buat background sedikit transparan dan tambahkan efek blur.
            if (isScrolled) {
              header.classList.remove('bg-black');
              header.classList.add('bg-black/80', 'backdrop-blur-sm', 'shadow-lg');
            } else {
              // Saat kembali ke atas, kembalikan ke background hitam solid.
              header.classList.add('bg-black');
              header.classList.remove('bg-black/80', 'backdrop-blur-sm', 'shadow-lg');
            }

            // Efek parallax untuk slider di homepage
            if (heroBg) {
              const scrollPosition = window.pageYOffset;
              heroBg.style.transform = `translateY(${scrollPosition * 0.4}px)`;
            }
          };

          // Hapus event listener lama untuk mencegah duplikasi
          window.removeEventListener('scroll', window.handleScroll);
          window.handleScroll = handleScroll; // Simpan referensi fungsi untuk bisa dihapus nanti
          window.addEventListener('scroll', window.handleScroll);

          // Hapus semua logika pengaturan state awal karena header sekarang statis.
          // Cukup pastikan efek parallax tetap berjalan.

          handleScroll(); // Panggil sekali untuk mengatur state awal

          // Jalankan efek mengetik jika di homepage
          if (isHomepage) {
            initTypingEffect();
          }
        };

        // Simpan fungsi inisialisasi ke window agar bisa diakses dari script SPA
        window.initializePageEffects = initializePageEffects;

        // Panggil saat halaman pertama kali dimuat
        initializePageEffects();
      });
    </script>

    <!-- SPA Navigation Script -->
    <script>
      /**
       * =================================================================
       * SPA-like Navigation using History API and Fetch (No Page Refresh)
       * =================================================================
       */
      const loadPage = async (url) => {
        const mainContainer = document.querySelector('main.flex-grow');
        if (!mainContainer) return; // Exit if no main container

        try {
          mainContainer.style.opacity = '0.5';
          mainContainer.style.transition = 'opacity 0.2s ease-in-out';

          const response = await fetch(url);
          const text = await response.text();

          const parser = new DOMParser();
          const newDoc = parser.parseFromString(text, 'text/html');

          const newMainContent = newDoc.querySelector('main.flex-grow');
          const newTitle = newDoc.querySelector('title')?.innerText || document.title;

          if (newMainContent) {
            mainContainer.parentNode.replaceChild(newMainContent, mainContainer);
            document.title = newTitle;

            // Re-run scripts inside the new main content
            const scripts = newMainContent.querySelectorAll('script');
            scripts.forEach(oldScript => {
              const newScript = document.createElement('script');
              Array.from(oldScript.attributes).forEach(attr => newScript.setAttribute(attr.name, attr.value));
              newScript.textContent = oldScript.textContent;
              oldScript.parentNode.replaceChild(newScript, oldScript);
            });

            // Panggil fungsi inisialisasi secara eksplisit setelah DOM diperbarui
            requestAnimationFrame(() => {
              // Panggil kembali fungsi untuk menyesuaikan efek header
              if (typeof window.initializePageEffects === 'function') {
                window.initializePageEffects();
              }
              if (typeof initHomepageSlider === 'function') {
                initHomepageSlider();
              }
              if (typeof initTokoSearch === 'function') {
                initTokoSearch();
              }
            });
          }
        } catch (error) {
          console.error('Page load failed:', error);
          window.location.href = url; // Fallback to normal navigation
        } finally {
          const finalContainer = document.querySelector('main.flex-grow');
          if (finalContainer) finalContainer.style.opacity = '1';
          window.scrollTo(0, 0);
        }
      };

      document.body.addEventListener('click', (e) => {
        const link = e.target.closest('a');
        // Pastikan link ada, bukan bagian dari form, dan memenuhi kriteria SPA
        if (
          link && link.href &&
          link.origin === window.location.origin &&
          !link.closest('form') && // <-- PERBAIKAN: Jangan jalankan jika link ada di dalam form
          !link.href.includes('#') && link.target !== '_blank' && !link.hasAttribute('download')
        ) {
          e.preventDefault();
          history.pushState({}, '', link.href);
          loadPage(link.href);
        }
      });

      window.addEventListener('popstate', () => {
        loadPage(window.location.href);
      });
    </script>
    </body>

    </html>