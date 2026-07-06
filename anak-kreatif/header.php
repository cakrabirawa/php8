<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars(SITE_TITLE); ?> - Toko & Kelas Menulis Anak</title>
  <!-- Preconnect & Google Font: Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    // Konfigurasi tema kustom dan aktifkan strategi 'class' untuk dark mode Tailwind
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          colors: {
            cerita: '#FF6B6B',
            sekolah: '#4ECDC4',
            tulisan: '#2F2F2F'
          },
          fontFamily: {
            sans: ['Poppins', 'ui-sans-serif', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial']
          }
        }
      }
    }

    // SCRIPT DETEKSI DINI TEMA: Mencegah layar berkedip saat pertama di-load
    if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  </script>
  <style>
    /* Global fallback to ensure Poppins is used even before Tailwind builds classes */
    html,
    body {
      font-family: 'Poppins', ui-sans-serif, system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
    }
  </style>
  <style>
    .line-clamp-2 {
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .line-clamp-3 {
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
  </style>
</head>

<body class="bg-transparent bg-amber-50 dark:bg-zinc-900 text-tulisan dark:text-zinc-100 font-sans flex flex-col min-h-screen transition-colors duration-300">

  <!-- Navigasi Utama -->
  <header id="main-header" class="sticky top-0 z-50 transition-all duration-300 border-b border-transparent">
    <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
      <!-- Tautan Logo Menggunakan BASE_URL -->
      <a href="<?= BASE_URL; ?>" class="text-2xl font-bold text-white flex items-center gap-2" title="<?= htmlspecialchars(SITE_TITLE); ?>">
        <span>🎨</span> <span><?= htmlspecialchars(SITE_TITLE); ?></span>
      </a>

      <!-- Area Kontrol Kanan (Menu Desktop & Tombol Mobile) -->
      <div class="flex items-center gap-6">
        <!-- Menu Navigasi Layar Lebar (Desktop) -->
        <div id="desktop-menu" class="hidden md:flex space-x-8 font-semibold text-sm items-center text-white">
          <a href="<?= BASE_URL; ?>" class="hover:text-amber-200 transition-colors">Beranda</a>
          <div class="relative group inline-block py-2">
            <a href="<?= BASE_URL; ?>toko" class="hover:text-cerita transition-colors">Toko Buku</a>
            <div class="absolute right-0 mt-2 w-48 bg-white dark:bg-zinc-800 rounded shadow-lg border opacity-0 invisible group-hover:opacity-100 group-hover:visible transition ease-out duration-150 z-50 pointer-events-none group-hover:pointer-events-auto">
              <?php
              // ambil daftar klasifikasi aktif jika koneksi DB tersedia
              if (!isset($conn)) {
                @include __DIR__ . '/config/database.php';
              }
              $klas_list = [];
              if (isset($conn)) {
                $kres = mysqli_query($conn, "SELECT nama, slug FROM klasifikasi_produk WHERE is_active=1 ORDER BY id");
                if ($kres) {
                  while ($kr = mysqli_fetch_assoc($kres)) {
                    $klas_list[] = $kr;
                  }
                }
              }
              foreach ($klas_list as $kl) : ?>
                <a href="<?= BASE_URL; ?>toko/klasifikasi/<?= urlencode($kl['slug']); ?>" class="block px-3 py-2 text-sm text-gray-700 dark:text-zinc-200 hover:bg-gray-50 dark:hover:bg-zinc-700 pointer-events-auto"><?= htmlspecialchars($kl['nama']); ?></a>
              <?php endforeach; ?>
            </div>
          </div>
          <a href="<?= BASE_URL; ?>kelas" class="hover:text-amber-200 transition-colors">Kelas Menulis</a>
        </div>

        <!-- Tombol Kontrol (Tema & Menu Mobile) -->
        <button id="theme-toggle-mobile" class="p-2 rounded-lg bg-white/10 dark:bg-white/10 text-white text-sm focus:outline-none" aria-label="Ubah Tema Mobile">
          <span class="dark:hidden">🌙</span>
          <span class="hidden dark:inline">☀️</span>
        </button>
        <button id="menu-toggle" class="md:hidden text-2xl text-white p-2 focus:outline-none">
          <span id="menu-icon-open">☰</span>
          <span id="menu-icon-close" class="hidden">✕</span>
        </button>
      </div>
    </nav>

    <!-- Menu Dropdown Khusus Mobile FIXED BASE_URL -->
    <div id="mobile-menu" class="hidden bg-white dark:bg-zinc-800 px-6 py-4 flex flex-col space-y-4 md:hidden border-t border-gray-100 dark:border-zinc-700 shadow-inner transition-colors duration-300">
      <a href="<?= BASE_URL; ?>" class="font-bold text-lg border-b border-gray-50 dark:border-zinc-700 pb-2 hover:text-cerita">Beranda</a>
      <a href="<?= BASE_URL; ?>toko" class="font-bold text-lg border-b border-gray-50 dark:border-zinc-700 pb-2 hover:text-cerita">Toko Buku</a>
      <?php if (!empty($klas_list)) : foreach ($klas_list as $kitem) : ?>
          <a href="<?= BASE_URL; ?>toko/klasifikasi/<?= urlencode($kitem['slug']); ?>" class="pl-4 text-sm text-gray-700 dark:text-zinc-200 hover:text-cerita">- <?= htmlspecialchars($kitem['nama']); ?></a>
      <?php endforeach;
      endif; ?>
      <a href="<?= BASE_URL; ?>kelas" class="font-bold text-lg border-b border-gray-50 dark:border-zinc-700 pb-2 hover:text-sekolah">Kelas Menulis</a>
    </div>
  </header>