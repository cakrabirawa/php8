    </main>

    <!-- Kaki Halaman (Footer Global) -->
    <footer class="bg-tulisan dark:bg-zinc-900 text-white py-10 mt-16 border-t-4 border-amber-200 dark:border-zinc-700 transition-colors duration-300">
      <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="text-center md:text-left">
          <h4 class="text-xl font-bold text-sekolah mb-1">🎨 AnakKreatif</h4>
          <p class="text-gray-400 dark:text-gray-500 text-sm max-w-sm">Ruang tumbuh kembang imajinasi dan bakat menulis literasi anak sejak dini.</p>
        </div>
        <div class="text-xs text-gray-500 font-medium tracking-wide">
          &copy; <?= date('Y'); ?> AnakKreatif. Dikembangkan secara Native dengan Struktur SEO.
        </div>
      </div>
    </footer>

    <!-- PERBAIKAN KRUSIAL: Menyisipkan BASE_URL agar pemanggilan berkas JS kebal dari eror 404 subfolder SEO -->
    <script src="<?= BASE_URL; ?>assets/js/main.js"></script>
    </body>

    </html>