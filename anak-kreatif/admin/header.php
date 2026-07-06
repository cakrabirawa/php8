<?php
require_once '../config/database.php';

// Fetch current admin's data to get the avatar
$current_admin_avatar = null;
if (isset($_SESSION['username_admin'])) {
  $username = $_SESSION['username_admin'];
  $stmt_user = mysqli_prepare($conn, "SELECT avatar FROM users_admin WHERE username = ?");
  mysqli_stmt_bind_param($stmt_user, 's', $username);
  mysqli_stmt_execute($stmt_user);
  $current_admin_avatar = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt_user))['avatar'] ?? null;
}
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id" class="<?= ADMIN_THEME === 'dark' ? 'dark' : '' ?>">

<head>
  <!-- CSRF Token for AJAX Requests -->
  <meta name="csrf-token" content="<?= htmlspecialchars($_SESSION['csrf_token']); ?>">
  <meta charset="UTF-8">
  <title>Panel Admin - AnakKreatif</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Google Fonts Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    /* Font Awesome */
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css');

    /* Chart.js responsive fix */
    .chart-container {
      position: relative;
      height: 250px;
      width: 100%;
    }

    body {
      font-family: 'Poppins', sans-serif;
    }

    /* Sembunyikan scrollbar tapi tetap bisa di-scroll */
    .hide-scrollbar {
      -ms-overflow-style: none;
      /* IE and Edge */
      scrollbar-width: none;
      /* Firefox */
    }

    .hide-scrollbar::-webkit-scrollbar {
      display: none;
      /* Chrome, Safari, and Opera */
    }
  </style>
  <!-- Memuat Pustaka Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-50 text-gray-800 text-xs flex h-screen overflow-hidden dark:bg-zinc-800 dark:text-zinc-200 transition-colors duration-300">
  <!-- Backup Loading Indicator -->
  <div id="backup-loader" class="hidden fixed inset-0 bg-gray-900/60 backdrop-blur-sm flex items-center justify-center z-[9999]">
    <div class="text-center text-white">
      <svg class="animate-spin h-8 w-8 text-white mx-auto mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
      </svg>
      <p class="font-bold text-lg">Mempersiapkan Backup...</p>
      <p class="text-sm opacity-80">Mohon tunggu, proses ini mungkin memakan waktu beberapa saat.</p>
    </div>
  </div>

  <!-- SPA Loading Progress Bar -->
  <div id="spa-progress-bar" class="fixed top-0 left-0 right-0 h-0.5 bg-orange-500 z-[9999]" style="width: 0%; transition: width 0.2s ease-out, opacity 0.2s ease-in; opacity: 0;"></div>

  <!-- Overlay Layar Gelap untuk Mobile -->
  <div id="sidebarOverlay" class="fixed inset-0 bg-gray-900/50 z-20 hidden md:hidden transition-opacity" onclick="toggleSidebar()"></div>

  <!-- Sidebar Navigasi Utama -->
  <aside id="sidebar" class="fixed md:static inset-y-0 left-0 w-64 bg-white shadow-[4px_0_24px_rgba(0,0,0,0.02)] flex-shrink-0 flex flex-col z-30 transform -translate-x-full md:translate-x-0 transition-transform duration-300 dark:bg-zinc-900 dark:border-r dark:border-zinc-700">
    <div class="p-6 flex items-center">
      <h2 class="text-xl font-black text-orange-500 flex items-center gap-2"><span>🎨</span> <?= htmlspecialchars(SITE_TITLE); ?></h2>
    </div>

    <!-- Area Tautan Menu -->
    <div class="flex-grow overflow-y-auto hide-scrollbar">
      <nav class="p-4 space-y-1.5">

        <a href="<?= ADMIN_URL ?>index" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition <?= $current_page == 'index.php' ? 'bg-orange-50 text-orange-600 dark:bg-orange-500/10' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800 dark:hover:bg-zinc-800' ?>">
          <span class="text-lg">📊</span> <span class="dark:text-zinc-300">Dashboard</span>
        </a>

        <div class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider mt-6 mb-2 px-4">Katalog Web</div>
        <a href="<?= ADMIN_URL ?>buku" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition <?= strpos($current_page, 'buku') !== false ? 'bg-orange-50 text-orange-600 dark:bg-orange-500/10' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800 dark:hover:bg-zinc-800' ?>">
          <span class="text-lg">📚</span> <span class="dark:text-zinc-300">Kelola Buku</span>
        </a>
        <a href="<?= ADMIN_URL ?>kelas" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition <?= strpos($current_page, 'kelas') !== false ? 'bg-teal-50 text-teal-600 dark:bg-teal-500/10' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800 dark:hover:bg-zinc-800' ?>">
          <span class="text-lg">✍️</span> <span class="dark:text-zinc-300">Kelola Kelas</span>
        </a>

        <div class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider mt-6 mb-2 px-4">Konten Media</div>
        <a href="<?= ADMIN_URL ?>videos" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition <?= strpos($current_page, 'videos') !== false ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800 dark:hover:bg-zinc-800' ?>">
          <span class="text-lg">🎬</span> <span class="dark:text-zinc-300">Kelola Video</span>
        </a>
        <a href="<?= ADMIN_URL ?>sliders" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition <?= strpos($current_page, 'sliders') !== false ? 'bg-amber-50 text-amber-600 dark:bg-amber-500/10' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800 dark:hover:bg-zinc-800' ?>">
          <span class="text-lg">🖼️</span> <span class="dark:text-zinc-300">Kelola Slider</span>
        </a>
        <a href="<?= ADMIN_URL ?>assets" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition <?= strpos($current_page, 'assets') !== false ? 'bg-purple-50 text-purple-600 dark:bg-purple-500/10' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800 dark:hover:bg-zinc-800' ?>">
          <span class="text-lg">🗂️</span> <span class="dark:text-zinc-300">File Manager</span>
        </a>

        <div class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider mt-6 mb-2 px-4">Data Master</div>
        <a href="<?= ADMIN_URL ?>categories" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition <?= strpos($current_page, 'categories') !== false ? 'bg-green-50 text-emerald-600 dark:bg-green-500/10' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800 dark:hover:bg-zinc-800' ?>">
          <span class="text-lg">📁</span> <span class="dark:text-zinc-300">Kategori Produk</span>
        </a>
        <a href="<?= ADMIN_URL ?>klasifikasi" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition <?= strpos($current_page, 'klasifikasi') !== false ? 'bg-sky-50 text-sky-600 dark:bg-sky-500/10' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800 dark:hover:bg-zinc-800' ?>">
          <span class="text-lg">🏷️</span> <span class="dark:text-zinc-300">Klasifikasi</span>
        </a>
        <a href="<?= ADMIN_URL ?>users" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition <?= strpos($current_page, 'users') !== false ? 'bg-blue-50 text-blue-600 dark:bg-blue-500/10' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800 dark:hover:bg-zinc-800' ?>">
          <span class="text-lg">👤</span> <span class="dark:text-zinc-300">Akun Admin</span>
        </a>

        <div class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider mt-6 mb-2 px-4">Sistem</div>
        <a href="<?= ADMIN_URL ?>pengaturan" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition <?= $current_page == 'pengaturan.php' ? 'bg-gray-200 text-gray-800 dark:bg-zinc-700 dark:text-zinc-100' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800 dark:hover:bg-zinc-800' ?>">
          <span class="text-lg">⚙️</span> <span class="dark:text-zinc-300">Konfigurasi</span>
        </a>
        <a href="<?= ADMIN_URL ?>backup-db" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-500 hover:bg-gray-50 hover:text-gray-800 dark:hover:bg-zinc-800">
          <span class="text-lg">💾</span> <span class="dark:text-zinc-300">Backup Database</span>
        </a>
      </nav>
    </div>

    <div class="p-4 border-t border-gray-50 space-y-3 bg-white dark:bg-zinc-900 dark:border-zinc-700">
      <div class="px-3 py-2 flex items-center gap-3 bg-gray-50 rounded-xl border border-gray-100 dark:bg-zinc-800 dark:border-zinc-700">
        <?php if (!empty($current_admin_avatar) && file_exists('../uploads/avatars/' . $current_admin_avatar)) : ?>
          <img id="sidebar-avatar-img" src="../uploads/avatars/<?= htmlspecialchars($current_admin_avatar); ?>" alt="Avatar" class="w-8 h-8 rounded-full object-cover">
        <?php else: ?>
          <div id="sidebar-avatar-initial" class="w-8 h-8 rounded-full bg-orange-200 flex flex-shrink-0 items-center justify-center text-orange-700 font-bold text-sm">
            <?= strtoupper(substr($_SESSION['admin_name'] ?? 'A', 0, 1)); ?>
          </div>
        <?php endif; ?>
        <div class="overflow-hidden">
          <p id="sidebar-admin-name" class="font-bold text-gray-700 truncate text-xs dark:text-zinc-200"><?= htmlspecialchars($_SESSION['admin_name'] ?? 'Admin'); ?></p>
          <p class="text-[9px] text-emerald-500 font-bold tracking-wide">● SEDANG AKTIF</p>
        </div>
      </div>
      <div class="grid grid-cols-2 gap-2">
        <a href="<?= BASE_URL ?>" target="_blank" class="flex justify-center items-center py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 font-bold transition text-[10px] dark:bg-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700">🌐 Website</a>
        <a href="<?= ADMIN_URL ?>logout" class="flex justify-center items-center py-2 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg font-bold transition text-[10px] dark:bg-red-500/10 dark:hover:bg-red-500/20">🚪 Keluar</a>
      </div>
    </div>
  </aside>

  <!-- Kontainer Utama (Area Kanan) -->
  <main class="flex-grow flex flex-col h-screen min-w-0 bg-gray-50 relative dark:bg-zinc-900">

    <!-- Header Utama (Kanan) -->
    <header class="bg-white p-3 shadow-sm flex items-center justify-between z-10 relative border-b border-gray-100 dark:bg-zinc-900 dark:border-zinc-700">
      <!-- Tombol Toggle Sidebar (Desktop & Mobile) -->
      <div>
        <button onclick="toggleSidebar()" class="md:hidden p-2 bg-gray-100 text-gray-600 rounded-lg text-lg focus:outline-none hover:bg-gray-200 transition dark:bg-zinc-800 dark:text-zinc-300">
          <!-- Ikon Hamburger (Open) -->
          <svg id="sidebar-icon-open" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <!-- Ikon Silang (Close) - Awalnya disembunyikan -->
          <svg id="sidebar-icon-close" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <!-- Menu Profil Pengguna -->
      <div class="relative">
        <button id="profile-menu-button" class="flex items-center gap-2">
          <?php if (!empty($current_admin_avatar) && file_exists('../uploads/avatars/' . $current_admin_avatar)) : ?>
            <img id="header-avatar-img" src="../uploads/avatars/<?= htmlspecialchars($current_admin_avatar); ?>" alt="Avatar" class="w-8 h-8 rounded-full object-cover">
          <?php else : ?>
            <div id="header-avatar-initial" class="w-8 h-8 rounded-full bg-orange-200 flex flex-shrink-0 items-center justify-center text-orange-700 font-bold text-sm">
              <?= strtoupper(substr($_SESSION['admin_name'] ?? 'A', 0, 1)); ?>
            </div>
          <?php endif; ?>
          <span id="header-admin-name" class="hidden md:inline font-semibold text-gray-700 dark:text-zinc-200"><?= htmlspecialchars($_SESSION['admin_name'] ?? 'Admin'); ?></span>
          <svg class="h-4 w-4 text-gray-400 hidden md:inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>

        <!-- Dropdown Menu -->
        <div id="profile-menu" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border py-2 z-20 dark:bg-zinc-800 dark:border-zinc-700">
          <div class="px-4 py-2 border-b dark:border-zinc-700">
            <p id="dropdown-admin-name" class="font-bold text-gray-800 dark:text-zinc-100"><?= htmlspecialchars($_SESSION['admin_name'] ?? 'Admin'); ?></p>
            <p class="text-xs text-gray-500 dark:text-zinc-400 truncate"><?= htmlspecialchars($_SESSION['username_admin'] ?? ''); ?></p>
          </div>
          <div class="py-1">
            <a href="<?= ADMIN_URL ?>profile" class="spa-trigger block px-4 py-2 text-xs font-semibold text-gray-700 hover:bg-gray-100 dark:text-zinc-300 dark:hover:bg-zinc-700">✏️ Update Profil</a>
            <a href="<?= ADMIN_URL ?>logout" class="block px-4 py-2 text-xs font-semibold text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-500/10">🚪 Keluar</a>
          </div>
        </div>
      </div>
    </header>

    <!-- Area Konten Utama Scrollable -->
    <div class="flex-grow overflow-y-auto p-5 md:p-8 hide-scrollbar">
      <div id="page-content-wrapper">
        <!-- Container untuk notifikasi AJAX -->
        <div id="notification-container" class="fixed top-5 right-5 z-50 w-full max-w-sm"></div>

        <script>
          document.addEventListener('DOMContentLoaded', () => {
            const profileMenuButton = document.getElementById('profile-menu-button');
            const profileMenu = document.getElementById('profile-menu');

            if (profileMenuButton && profileMenu) {
              profileMenuButton.addEventListener('click', (event) => {
                event.stopPropagation(); // Mencegah event klik menyebar ke window
                profileMenu.classList.toggle('hidden');
              });

              // Menutup dropdown jika klik di luar area menu
              window.addEventListener('click', (event) => {
                if (!profileMenu.classList.contains('hidden') && !profileMenu.contains(event.target) && !profileMenuButton.contains(event.target)) {
                  profileMenu.classList.add('hidden');
                }
              });
            }
          });
        </script>