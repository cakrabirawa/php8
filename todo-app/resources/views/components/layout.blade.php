<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'TailAdmin - Dashboard' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body 
    class="bg-[#f1f5f9] text-[#1c2434] font-sans antialiased" 
    x-data="{ sidebarOpen: window.innerWidth >= 768 }"
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
            class="fixed inset-y-0 left-0 z-50 transition-all duration-300 transform md:relative md:translate-x-0"
            :class="sidebarOpen ? 'translate-x-0 w-64' : '-translate-x-full md:w-0 md:overflow-hidden'"
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