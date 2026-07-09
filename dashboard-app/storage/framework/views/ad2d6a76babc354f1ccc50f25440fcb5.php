<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="page-title"><?php echo $__env->yieldContent('title', 'Dashboard App'); ?></title>

    <!-- Google Fonts Poppins -->
    <!-- Ambil Google Fonts Poppins via CDN HTML (Sangat Stabil) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>

    <!-- Script Anti-Flicker Dark Mode -->
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <style>
        *,
        ::after,
        ::before {
            font-family: 'Poppins', sans-serif !important;
        }
    </style>
</head>

<body
    class="bg-gray-100 dark:bg-slate-950 antialiased text-gray-800 dark:text-slate-200 transition-colors duration-200">

    <div class="flex h-screen overflow-hidden relative">

        <!-- SIDEBAR -->
        <aside id="sidebar"
            class="w-64 bg-slate-900 dark:bg-slate-950 text-white flex flex-col flex-shrink-0 transform transition-transform duration-300 ease-in-out fixed inset-y-0 left-0 z-40 md:relative md:transform-none border-r border-transparent dark:border-slate-800">
            <div
                class="h-16 flex items-center justify-center bg-slate-950 font-bold text-xl tracking-wider text-blue-400">
                🚀 MY DASHBOARD
            </div>
            <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                <a href="<?php echo e(url('/')); ?>"
                    class="sidebar-link ajax-link flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 dark:hover:bg-slate-900 transition <?php echo e(Request::is('/') ? 'bg-blue-600 text-white' : 'text-slate-400'); ?>">
                    <span class="mr-3">📊</span> Beranda
                </a>
                <a href="<?php echo e(url('/produk')); ?>"
                    class="sidebar-link ajax-link flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 dark:hover:bg-slate-900 transition <?php echo e(Request::is('produk') ? 'bg-blue-600 text-white' : 'text-slate-400'); ?>">
                    <span class="mr-3">📦</span> Manajemen Produk
                </a>
                <a href="<?php echo e(url('/pengguna')); ?>"
                    class="sidebar-link ajax-link flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 dark:hover:bg-slate-900 transition <?php echo e(Request::is('pengguna') ? 'bg-blue-600 text-white' : 'text-slate-400'); ?>">
                    <span class="mr-3">👥</span> Data Pengguna
                </a>
            </nav>
        </aside>

        <!-- OVERLAY BACKDROP -->
        <div id="sidebar-overlay" onclick="toggleSidebar()" class="hidden fixed inset-0 bg-black/40 z-30 md:hidden">
        </div>

        <!-- AREA KANAN -->
        <div class="flex flex-col flex-1 min-w-0 overflow-hidden">

            <!-- HEADER -->
            <header
                class="h-16 bg-white dark:bg-slate-900 border-b border-gray-200 dark:border-slate-800 flex items-center justify-between px-6 flex-shrink-0 transition-colors duration-200">
                <div class="flex items-center space-x-4">
                    <button onclick="toggleSidebar()"
                        class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-800 text-gray-600 dark:text-slate-400 focus:outline-none transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://w3.org">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <div class="font-semibold text-lg text-gray-700 dark:text-slate-200 hidden sm:block">Sistem
                        Manajemen Internal</div>
                </div>

                <div class="flex items-center space-x-4">
                    <!-- TOMBOL TOGGLE THEME -->
                    <button onclick="toggleTheme()"
                        class="p-2 rounded-lg bg-gray-100 dark:bg-slate-800 hover:bg-gray-200 dark:hover:bg-slate-700 text-gray-700 dark:text-yellow-400 transition focus:outline-none">
                        <svg id="theme-toggle-dark-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://w3.org">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                        <svg id="theme-toggle-light-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://w3.org">
                            <path
                                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464a1 1 0 101.414-1.414l-.707-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 100 2h1z"
                                fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                    </button>

                    <!-- PROFIL USER -->
                    <div class="flex items-center space-x-3 border-l pl-4 border-gray-200 dark:border-slate-800">
                        <div
                            class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold text-sm">
                            AD</div>
                        <span
                            class="text-sm font-medium text-gray-700 dark:text-slate-300 hidden md:block">Administrator</span>
                    </div>
                </div>
            </header>

            <!-- KONTEN DINAMIS -->
            <main
                class="flex-1 overflow-x-hidden overflow-y-auto p-6 bg-gray-50 dark:bg-slate-900 transition-colors duration-200">
                <div id="page-content" class="transition-opacity duration-150">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </main>

            <!-- FOOTER -->
            <footer
                class="h-12 bg-white dark:bg-slate-900 border-t border-gray-200 dark:border-slate-800 flex items-center justify-between px-6 text-xs text-gray-500 dark:text-slate-400 flex-shrink-0 transition-colors duration-200">
                <div>© 2026 Dashboard App Corp.</div>
                <div>Versi 1.0.0</div>
            </footer>

        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const lightIcon = document.getElementById('theme-toggle-light-icon');

        // 1. MANAJEMEN TEMA (LIGHT / DARK)
        function updateThemeIcons() {
            if (document.documentElement.classList.contains('dark')) {
                lightIcon.classList.remove('hidden');
                darkIcon.classList.add('hidden');
            } else {
                darkIcon.classList.remove('hidden');
                lightIcon.classList.add('hidden');
            }
        }

        function toggleTheme() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
            updateThemeIcons();
        }
        document.addEventListener('DOMContentLoaded', updateThemeIcons);

        // 2. RESPONSIVE SIDEBAR
        function toggleSidebar() {
            if (window.innerWidth < 768) {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            } else {
                sidebar.classList.toggle('md:hidden');
            }
        }

        function handleResize() {
            if (window.innerWidth < 768) {
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('md:hidden');
                overlay.classList.add('hidden');
            } else {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }
        window.addEventListener('resize', handleResize);
        document.addEventListener('DOMContentLoaded', handleResize);

        // 3. AJAX NAVIGATION
        document.addEventListener('DOMContentLoaded', () => {
            document.addEventListener('click', (e) => {
                const link = e.target.closest('.ajax-link');
                if (link) {
                    e.preventDefault();
                    const url = link.getAttribute('href');
                    loadPage(url, true);
                    if (window.innerWidth < 768) { toggleSidebar(); }
                }
            });

            async function loadPage(url, pushState = true) {
                const contentArea = document.getElementById('page-content');
                contentArea.classList.add('opacity-30');
                try {
                    const response = await fetch(url, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'text/html' }
                    });
                    if (!response.ok) throw new Error('Gagal memuat.');
                    const html = await response.text();
                    contentArea.innerHTML = html;

                    const newTitle = document.getElementById('ajax-title-bridge')?.value || 'Dashboard App';
                    document.getElementById('page-title').innerText = newTitle;
                    updateSidebarActiveState(url);

                    if (pushState) { history.pushState({ url: url }, newTitle, url); }
                } catch (error) {
                    console.error(error);
                    contentArea.innerHTML = '<div class="text-red-500 font-medium p-4">Terjadi kesalahan saat memuat konten.</div>';
                } finally { contentArea.classList.remove('opacity-30'); }
            }

            function updateSidebarActiveState(currentUrl) {
                const links = document.querySelectorAll('.sidebar-link');
                links.forEach(link => {
                    const target = link.getAttribute('href');
                    if (target === currentUrl || (currentUrl.endsWith('/') && target.endsWith('/'))) {
                        link.className = "sidebar-link ajax-link flex items-center px-4 py-3 rounded-lg bg-blue-600 text-white transition";
                    } else {
                        link.className = "sidebar-link ajax-link flex items-center px-4 py-3 rounded-lg text-slate-400 hover:bg-slate-800 dark:hover:bg-slate-900 transition";
                    }
                });
            }

            window.addEventListener('popstate', (e) => {
                const targetUrl = e.state ? e.state.url : window.location.href;
                loadPage(targetUrl, false);
            });
            history.replaceState({ url: window.location.href }, document.title, window.location.href);
        });
    </script>
</body>

</html><?php /**PATH D:\projects\php8\dashboard-app\resources\views/layouts/app.blade.php ENDPATH**/ ?>