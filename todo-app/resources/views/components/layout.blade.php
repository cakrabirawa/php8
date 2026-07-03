<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="tab-title">{{ $title ?? 'TailAdmin - Dashboard' }}</title>
    
    <!-- SCRIPT CEK DARK MODE INSTAN SEBELUM PAGE DI-RENDER -->
    <script>
        if (localStorage.getItem('darkMode') === 'true' || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- DAFTARKAN LOGIKA AJAX FETCH SPA DENGAN HISTORY -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('spa', {
                isLoading: false,
                init() {
                    window.addEventListener('popstate', async () => {
                        const path = window.location.pathname;
                        let pageTitle = 'TailAdmin';
                        if (path === '/') pageTitle = 'Analytics - TailAdmin';
                        if (path === '/calendar') pageTitle = 'Calendar - TailAdmin';
                        if (path === '/ticket-list') pageTitle = 'Ticket List - TailAdmin';
                        if (path === '/ticket-reply') pageTitle = 'Ticket Reply - TailAdmin';
                        window.dispatchEvent(new CustomEvent('path-changed', { detail: { path: path } }));
                        await this.fetchContent(path, pageTitle, false);
                    });
                },
                async loadPage(url, title) {
                    if (window.location.pathname === url) return;
                    await this.fetchContent(url, title, true);
                },
                async fetchContent(url, title, pushHistory = true) {
                    this.isLoading = true;
                    try {
                        const response = await fetch(url, { headers: { 'X-Injected-Page': 'true' } });
                        if (!response.ok) throw new Error('Gagal mengambil data halaman');
                        const html = await response.text();
                        const container = document.getElementById('spa-target-content');
                        if (container) { container.innerHTML = html; }
                        if (pushHistory) { window.history.pushState({}, '', url); }
                        document.getElementById('tab-title').innerText = title;
                    } catch (error) {
                        console.error(error);
                        document.getElementById('spa-target-content').innerHTML = `<div class="bg-red-50 p-4 rounded-xl text-red-600 text-sm"><strong>Error:</strong> ${error.message}</div>`;
                    } finally { this.isLoading = false; }
                }
            });
        });
    </script>

    <!-- 3. TAMBAHKAN IMPORT GOOGLE FONTS POPPINS DI SINI -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak] { display: none !important; }</style>
</head>

<body 
    class="bg-[#f1f5f9] text-[#1c2434] dark:bg-[#1a222c] dark:text-[#aebbc8] font-sans antialiased transition-colors duration-200" 
    x-data="{ 
        sidebarOpen: window.innerWidth >= 768,
        darkMode: localStorage.getItem('darkMode') === 'true'
    }"
    x-init="
        $watch('darkMode', val => {
            localStorage.setItem('darkMode', val);
            if (val) { document.documentElement.classList.add('dark') }
            else { document.documentElement.classList.remove('dark') }
        })
    "
    @resize.window="if (window.innerWidth < 768) { sidebarOpen = false } else { sidebarOpen = true }"
>
    <div class="flex h-screen overflow-hidden relative">
        <!-- Overlay mobile -->
        <div x-show="sidebarOpen" x-transition:opacity class="fixed inset-0 z-40 bg-black/40 md:hidden" @click="sidebarOpen = false" x-cloak></div>
        
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 z-50 transition-all duration-300 transform md:relative" :class="sidebarOpen ? 'translate-x-0 w-64' : '-translate-x-full md:w-0 md:overflow-hidden'" x-cloak>
            <x-sidebar />
        </div>

        <!-- Konten Kanan -->
        <div class="flex-1 flex flex-col overflow-y-auto">
            <x-header />

            <main class="p-6 md:p-8 max-w-full w-full mx-auto space-y-6 relative flex-1">
                <div x-show="$store.spa.isLoading" class="absolute inset-0 bg-white/50 dark:bg-slate-900/50 flex items-center justify-center z-40" x-cloak>
                    <div class="w-9 h-9 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
                </div>

                <div id="spa-target-content" class="transition-all duration-200">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</body>
</html>