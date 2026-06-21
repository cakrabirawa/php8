<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Dashboard Sidebar</title>

    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<!-- STATE MANAGEMENT VIA ALPINEJS -->

<body x-data="{ sidebarOpen: true, mobileSidebar: false }"
    class="bg-gray-100 font-sans antialiased text-gray-900 overflow-hidden">

    <!-- Topbar khusus perangkat Mobile -->
    <div
        class="p-4 md:hidden flex justify-between items-center bg-white shadow-xs border-b border-gray-200 relative z-30">
        <span class="font-bold text-gray-800">BrandAdmin</span>
        <button @click="mobileSidebar = !mobileSidebar"
            class="text-gray-600 p-1 hover:text-gray-900 focus:outline-hidden cursor-pointer">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>
    </div>

    <!-- Container Utama Aplikasi -->
    <div class="flex h-screen w-screen overflow-hidden relative">

        <!-- Backdrop Mobile Layer Overlay -->
        <div @click="mobileSidebar = false" :class="mobileSidebar ? '' : 'hidden'"
            class="fixed inset-0 bg-black/50 z-40 md:hidden"></div>

        <!-- SIDEBAR UTAMA (Lebar dikontrol dinamis oleh Alpine.js) -->
        <aside id="sidebar" :class="{
                   'w-64 md:w-64': sidebarOpen,
                   'w-64 md:w-0': !sidebarOpen,
                   'translate-x-0': mobileSidebar,
                   '-translate-x-full md:translate-x-0': !mobileSidebar
               }"
            class="fixed inset-y-0 left-0 bg-slate-900 text-slate-300 transition-[width,transform] duration-500 ease-[cubic-bezier(0.34,1.56,0.64,1)] z-50 flex flex-col h-full shadow-lg shrink-0 overflow-hidden">

            <!-- Sidebar Header Brand + TOMBOL TOGGLE DESKTOP BARU -->
            <div
                class="h-16 flex items-center justify-between px-4 bg-slate-950 text-white font-bold text-xl border-b border-slate-800 shrink-0 w-64">
                <div class="flex items-center space-x-2">
                    <svg class="w-6 h-6 text-indigo-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4">
                        </path>
                    </svg>
                    <span>BrandAdmin</span>
                </div>

                <!-- Tombol Action (Desktop: Sembunyikan | Mobile: Tutup) -->
                <div>
                    <!-- Muncul di Desktop -->
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="hidden md:block text-slate-400 hover:text-white focus:outline-hidden cursor-pointer p-1 rounded-md hover:bg-slate-800"
                        title="Sembunyikan Sidebar">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h12M4 18h16"></path>
                        </svg>
                    </button>
                    <!-- Muncul di Mobile -->
                    <button @click="mobileSidebar = false"
                        class="md:hidden text-slate-400 hover:text-white focus:outline-hidden">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Memanggil Menu Navigasi Komponen x-sidebar -->
            <div class="flex-1 overflow-y-auto p-4 space-y-1 w-64 shrink-0">
                <x-sidebar />
            </div>
        </aside>

        <!-- Area Kanan: Topbar Utama + Content Area -->
        <div class="flex-1 flex flex-col min-w-0 h-full relative z-10 w-full">

            <!-- Topbar Desktop (Tetap Menyediakan Tombol Cadangan Jika Sidebar Tertutup) -->
            <header
                class="hidden md:flex h-16 bg-white border-b border-gray-200 items-center px-6 justify-between shrink-0 relative z-20">
                <div class="flex items-center">
                    <!-- Tombol ini otomatis muncul ke permukaan HANYA JIKA sidebar sedang dalam kondisi tertutup (w-0) -->
                    <button x-show="!sidebarOpen" x-cloak @click="sidebarOpen = true"
                        class="text-gray-500 hover:text-gray-700 p-2 hover:bg-gray-100 rounded-lg transition-colors focus:outline-hidden cursor-pointer flex items-center justify-center mr-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <span class="text-sm font-semibold text-gray-500 tracking-wide uppercase">System Panel</span>
                </div>

                <div class="flex items-center space-x-4">
                    <span class="text-sm font-medium text-gray-600">{{ Auth::user()->name }}</span>
                </div>
            </header>

            <!-- Wadah Target Penggantian Content Parsial AJAX Fetch -->
            <main id="content-area" class="flex-1 p-6 overflow-y-auto bg-gray-50 relative z-10">
                {{ $slot }}
            </main>
        </div>
    </div>

</body>

</html>
