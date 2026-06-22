<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="tab-title">{{ $title ?? 'TailAdmin - Dashboard' }}</title>
    
    <!-- 1. DETEKSI DARK MODE INSTAN -->
    <script>
        if (localStorage.getItem('darkMode') === 'true' || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- 2. DAFTARKAN LOGIKA AJAX FETCH SPA -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('spa', {
                isLoading: false,

                // Tambahkan init untuk mendengarkan tombol back/forward browser secara global
                init() {
                    window.addEventListener('popstate', async () => {
                        // Jalankan fetch konten secara otomatis saat tombol back/forward ditekan
                        await this.fetchContent(window.location.pathname, document.title, false);
                    });
                },

                async loadPage(url, title) {
                    // Jika mengklik halaman yang sama, abaikan
                    if (window.location.pathname === url) return;
                    // Panggil fungsi utama dengan parameter pushHistory = true
                    await this.fetchContent(url, title, true);
                },

                async fetchContent(url, title, pushHistory = true) {
                    this.isLoading = true;
                    try {
                        const response = await fetch(url, {
                            headers: { 'X-Injected-Page': 'true' }
                        });
                        if (!response.ok) throw new Error('Gagal mengambil data halaman');
                        
                        const html = await response.text();
                        
                        // SUNTIK HTML KE KONTAINER TENGAH
                        const container = document.getElementById('spa-target-content');
                        if (container) {
                            container.innerHTML = html;
                        }
                        
                        // ATUR HISTORY & TITLE TAB BROWSER
                        if (pushHistory) {
                            window.history.pushState({}, '', url);
                        }
                        document.getElementById('tab-title').innerText = title;
                    } catch (error) {
                        console.error(error);
                        document.getElementById('spa-target-content').innerHTML = `
                            <div class="bg-red-50 p-4 rounded-xl border border-red-200 text-red-600 text-sm">
                                <strong>Error:</strong> ${error.message}
                            </div>
                        `;
                    } finally {
                        this.isLoading = false;
                    }
                }
            });
        });
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body 
    class="bg-[#f1f5f9] text-[#1c2434] dark:bg-[#1a222c] dark:text-[#aebbc8] font-sans antialiased" 
    x-data="{ 
        sidebarOpen: window.innerWidth >= 768,
        darkMode: localStorage.getItem('darkMode') === 'true'
    }"
    x-init="$watch('darkMode', val => {
        localStorage.setItem('darkMode', val);
        if (val) { document.documentElement.classList.add('dark') }
        else { document.documentElement.classList.remove('dark') }
    })"
    @resize.window="if (window.innerWidth < 768) { sidebarOpen = false } else { sidebarOpen = true }"
>
    <div class="flex h-screen overflow-hidden relative">
        <div x-show="sidebarOpen" x-transition:opacity class="fixed inset-0 z-40 bg-black/40 md:hidden" @click="sidebarOpen = false" x-cloak></div>
        
        <div class="fixed inset-y-0 left-0 z-50 transition-all duration-300 transform md:relative" :class="sidebarOpen ? 'translate-x-0 w-64' : '-translate-x-full md:w-0 md:overflow-hidden'" x-cloak>
            <x-sidebar />
        </div>

        <div class="flex-1 flex flex-col overflow-y-auto">
            <x-header />

            <!-- ================= WADAH UTAMA KONTEN TENGAH ================= -->
            <main class="p-6 md:p-8 max-w-7xl w-full mx-auto space-y-6 relative flex-1">
                
                <!-- Animasi Loading Ringan Saat Berpindah Halaman -->
                <div x-show="$store.spa.isLoading" class="absolute inset-0 bg-white/50 dark:bg-slate-900/50 flex items-center justify-center z-40" x-cloak>
                    <div class="w-9 h-9 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
                </div>

                <!-- TARGET UTAMA: Konten yang disuntik AJAX akan masuk ke dalam id ini -->
                <div id="spa-target-content" class="transition-all duration-200">
                    {{ $slot }}
                </div>

            </main>
        </div>
    </div>
</body>
</html>