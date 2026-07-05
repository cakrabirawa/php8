    <!-- Kaki Halaman (Footer Global) -->
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
        const header = document.getElementById('main-header');
        const heroBg = document.getElementById('slider-bg-wrapper');
        const desktopMenu = document.getElementById('desktop-menu');

        const handleScroll = () => {
          // Efek Header
          const isScrolled = window.scrollY > -1; // Sedikit buffer untuk transisi yang lebih baik
          const logoLink = header.querySelector('a[title]');

          if (isScrolled) {
            console.log("a")
            // Saat di-scroll ke bawah: tambahkan background, shadow, dan ubah warna teks menjadi gelap.
            header.classList.add('bg-black/90', 'dark:bg-zinc-900/90', 'backdrop-blur-lg', 'shadow-sm', 'border-gray-100', 'dark:border-zinc-800');
            if (desktopMenu) {
              // desktopMenu.classList.remove('text-white');
              desktopMenu.classList.add('text-tulisan', 'dark:text-zinc-100');
            }
            if (logoLink) {
              // logoLink.classList.remove('text-white');
              logoLink.classList.add('text-cerita', 'dark:text-zinc-100');
            }
          } else {
            console.log("b")
            // Saat di paling atas: hapus background dan kembalikan warna teks ke putih.
            header.classList.remove('bg-black/100', 'dark:bg-zinc-900/90', 'backdrop-blur-lg', 'shadow-sm', 'border-gray-100', 'dark:border-zinc-800');
            if (desktopMenu) {
              desktopMenu.classList.add('text-white');
              desktopMenu.classList.remove('text-tulisan', 'dark:text-zinc-100');
            }
            if (logoLink) {
              logoLink.classList.add('text-white');
              logoLink.classList.remove('text-cerita');
            }
          }

          // Efek Parallax
          if (heroBg) {
            const scrollPosition = window.pageYOffset;
            heroBg.style.transform = `translateY(${scrollPosition * 0.4}px)`;
          }
        };

        window.addEventListener('scroll', handleScroll);

        // Panggil handleScroll sekali saat halaman dimuat untuk mengatur state awal
        handleScroll();
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