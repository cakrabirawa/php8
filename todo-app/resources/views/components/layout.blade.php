<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'TailAdmin - Dashboard' }}</title>
    <!-- SCRIPT CEK DARK MODE INSTAN (Taruh paling atas di head) -->
    <script>
        if (localStorage.getItem('darkMode') === 'true' || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
        
        <!-- SIDEBAR MOBILE OVERLAY (Hanya aktif di layar kecil < md) -->
        <div 
            x-show="sidebarOpen" 
            x-transition:opacity
            class="fixed inset-0 z-40 bg-black/40 md:hidden" 
            @click="sidebarOpen = false"
            x-cloak
        ></div>

        <!-- SIDEBAR CONTAINER (Responsif: Slide-over di mobile, Push-content di desktop) -->
        <div 
            class="fixed inset-y-0 left-0 z-50 transition-all duration-300 ease-in-out transform md:relative"
            :class="sidebarOpen ? 'translate-x-0 w-64 opacity-100' : '-translate-x-full md:w-0 md:opacity-0 md:overflow-hidden'"
            @click.outside="if (window.innerWidth < 768) sidebarOpen = false"
            x-cloak
        >
            <x-sidebar />
        </div>

        <!-- Halaman Konten Utama -->
        <div class="flex-1 flex flex-col overflow-y-auto">
            
            <!-- Header Component -->
            <x-header />

            <!-- Konten Halaman -->
            <main class="p-6 md:p-8 max-w-7xl w-full mx-auto space-y-6">
                {{ $slot }}
            </main>
            
        </div>
    </div>
</body>
</html>