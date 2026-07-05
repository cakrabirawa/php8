      </div> <!-- End page-content-wrapper -->
      </div> <!-- End flex-grow -->
      </main> <!-- End Main Container -->

      <script>
        function toggleSidebar() {
          const sidebar = document.getElementById('sidebar');
          const overlay = document.getElementById('sidebarOverlay');
          sidebar.classList.toggle('-translate-x-full');
          overlay.classList.toggle('hidden');
        }
      </script>

      <!-- Memuat skrip AJAX kustom -->
      <script src="<?= BASE_URL; ?>assets/js/admin-ajax.js"></script>
      <script src="<?= BASE_URL; ?>assets/js/admin-search.js"></script>

      <!-- SPA Navigation Script for Admin Panel -->
      <script>
        /**
         * =================================================================
         * SPA-like Navigation for Admin Panel
         * =================================================================
         */

        /**
         * Re-initializes all dynamic scripts on the page.
         * This should be called after new content is loaded via AJAX.
         */
        const reinitializeScripts = () => {
          // Re-initialize live search
          if (typeof initLiveSearch === 'function') {
            const searchInputs = [{
                input: 'live-search-buku',
                table: 'table-buku-body',
                noResults: 'no-results-buku'
              },
              {
                input: 'live-search-kelas',
                table: 'table-kelas-body',
                noResults: 'no-results-kelas'
              },
              {
                input: 'live-search-videos',
                table: 'table-videos-body',
                noResults: 'no-results-videos'
              },
              {
                input: 'live-search-categories',
                table: 'table-categories-body',
                noResults: 'no-results-categories'
              },
              {
                input: 'live-search-klasifikasi',
                table: 'table-klasifikasi-body',
                noResults: 'no-results-klasifikasi'
              },
              {
                input: 'live-search-users',
                table: 'table-users-body',
                noResults: 'no-results-users'
              },
            ];

            searchInputs.forEach(config => {
              if (document.getElementById(config.input)) {
                initLiveSearch(config.input, config.table, config.noResults);
              }
            });
          }

          // Re-initialize visitor chart
          const visitorChartCanvas = document.getElementById('visitorChart');
          if (visitorChartCanvas && typeof Chart !== 'undefined') {
            const isDarkMode = document.documentElement.classList.contains('dark');
            const chartDataElement = document.getElementById('chart-data-container');

            if (chartDataElement) {
              // Destroy existing chart instance if it exists, to prevent conflicts
              if (visitorChartCanvas.chart) {
                visitorChartCanvas.chart.destroy();
              }

              const labels = JSON.parse(chartDataElement.dataset.labels);
              const data = JSON.parse(chartDataElement.dataset.data);

              const newChart = new Chart(visitorChartCanvas, {
                type: 'line',
                data: {
                  labels: labels,
                  datasets: [{
                    label: 'Kunjungan',
                    data: data,
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    fill: true,
                    tension: 0.3,
                    pointBackgroundColor: 'rgb(59, 130, 246)',
                    pointRadius: 4,
                  }]
                },
                options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  scales: {
                    y: {
                      beginAtZero: true,
                      ticks: {
                        color: isDarkMode ? '#a1a1aa' : '#6b7280',
                        precision: 0
                      },
                      grid: {
                        color: isDarkMode ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.05)'
                      }
                    },
                    x: {
                      ticks: {
                        color: isDarkMode ? '#a1a1aa' : '#6b7280'
                      },
                      grid: {
                        display: false
                      }
                    }
                  },
                  plugins: {
                    legend: {
                      display: false
                    }
                  }
                }
              });
              visitorChartCanvas.chart = newChart; // Store reference to the new chart
            }
          }

          // Re-attach AJAX form handlers
          if (typeof handleAjaxFormSubmit === 'function') {
            document.querySelectorAll('form.ajax-form').forEach(form => {
              // To prevent duplicate listeners, we can add a marker
              if (!form.hasAttribute('data-ajax-initialized')) {
                form.setAttribute('data-ajax-initialized', 'true');
                form.addEventListener('submit', (e) => {
                  e.preventDefault();
                  handleAjaxFormSubmit(form);
                });
              }
            });
          }
        };

        const updateActiveMenu = (url) => {
          const sidebarLinks = document.querySelectorAll('#sidebar nav a[href]');
          const currentPath = new URL(url).pathname;

          sidebarLinks.forEach(link => {
            const linkPath = new URL(link.href).pathname;
            const isActive = linkPath === currentPath;

            // Ambil kelas dari data-* attributes
            const activeClasses = link.dataset.activeClasses || '';
            const originalClasses = link.dataset.originalClasses || '';

            // Reset kelas dasar
            link.className = 'flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition';

            if (isActive && activeClasses) {
              link.classList.add(...activeClasses.split(' '));
            } else if (originalClasses) {
              link.classList.add(...originalClasses.split(' '));
            }
          });
        };

        const loadAdminPage = async (url) => {
          const contentWrapper = document.getElementById('page-content-wrapper');
          if (!contentWrapper) return;

          try {
            contentWrapper.style.opacity = '0.5';
            contentWrapper.style.transition = 'opacity 0.2s ease-in-out';

            const response = await fetch(url);
            const text = await response.text();

            const parser = new DOMParser();
            const newDoc = parser.parseFromString(text, 'text/html');

            // Target the new wrapper ID
            const newContentWrapper = newDoc.getElementById('page-content-wrapper');
            const newTitle = newDoc.querySelector('title')?.innerText || document.title;

            if (newContentWrapper) {
              // Clear old content
              while (contentWrapper.firstChild) {
                contentWrapper.removeChild(contentWrapper.firstChild);
              }

              // Append new nodes and execute scripts
              Array.from(newContentWrapper.childNodes).forEach(node => {
                if (node.nodeName === 'SCRIPT') {
                  const newScript = document.createElement('script');
                  // Copy attributes
                  Array.from(node.attributes).forEach(attr => newScript.setAttribute(attr.name, attr.value));
                  // Copy content
                  newScript.textContent = node.textContent;
                  contentWrapper.appendChild(newScript);
                } else {
                  contentWrapper.appendChild(node.cloneNode(true));
                }
              });

              document.title = newTitle;

              // Re-initialize scripts for the new content
              reinitializeScripts();

              // Update the active state in the sidebar
              updateActiveMenu(url);
            }
          } catch (error) {
            console.error('Admin page load failed:', error);
            window.location.href = url; // Fallback to normal navigation
          } finally {
            contentWrapper.style.opacity = '1';
            // Scroll the main scrollable area, not the wrapper
            document.querySelector('.flex-grow.overflow-y-auto').scrollTo(0, 0);
          }
        };

        // Gabungkan semua event listener klik ke dalam satu handler
        document.body.addEventListener('click', async (e) => {
          const link = e.target.closest('a');
          if (!link) return;

          const isBackupLink = link.href && link.href.includes('backup-db');
          const isSpaLink = link.href && link.origin === window.location.origin && (link.closest('#sidebar nav a') || link.closest('.flex.justify-center.gap-1 a') || link.classList.contains('spa-trigger'));

          // Handle Backup Link
          if (isBackupLink) {
            e.preventDefault();
            const loader = document.getElementById('backup-loader');
            if (loader) loader.classList.remove('hidden');

            try {
              const response = await fetch(link.href);
              if (!response.ok) throw new Error(`Server error: ${response.status}`);

              const sqlContent = await response.text();
              const blob = new Blob([sqlContent], {
                type: 'application/sql'
              });
              const url = window.URL.createObjectURL(blob);
              const a = document.createElement('a');
              a.style.display = 'none';
              a.href = url;
              a.download = `backup-db-anak-kreatif-${new Date().toISOString().slice(0, 10)}.sql`;
              document.body.appendChild(a);
              a.click();
              window.URL.revokeObjectURL(url);
              a.remove();
            } catch (error) {
              console.error('Database backup failed:', error);
              alert('Gagal membuat backup database.');
            } finally {
              if (loader) loader.classList.add('hidden');
            }
            return;
          }

          // Handle SPA Navigation Link
          if (isSpaLink) {
            e.preventDefault();
            history.pushState({}, '', link.href);
            loadAdminPage(link.href);
          }
        });

        window.addEventListener('popstate', () => {
          loadAdminPage(window.location.href);
        });

        // Store original classes on initial page load
        const storeInitialMenuClasses = () => {
          document.querySelectorAll('#sidebar nav a[href]').forEach(link => {
            const baseClasses = 'flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition';
            const allCurrentClasses = Array.from(link.classList);
            const specificClasses = allCurrentClasses.filter(cls => !baseClasses.includes(cls));

            if (specificClasses.some(cls => cls.startsWith('bg-') && cls !== 'bg-gray-50')) {
              // This link is currently active
              link.setAttribute('data-active-classes', specificClasses.join(' '));
              link.setAttribute('data-original-classes', 'text-gray-500 hover:bg-gray-50 hover:text-gray-800 dark:hover:bg-zinc-800');
            } else {
              // This link is not active
              link.setAttribute('data-original-classes', specificClasses.join(' '));
            }
          });
        };

        storeInitialMenuClasses();

        // Jalankan inisialisasi skrip saat halaman pertama kali dimuat
        reinitializeScripts();
      </script>
      </body>

      </html>