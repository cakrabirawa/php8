<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Dashboard SPA</title>

    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans antialiased text-gray-900 overflow-hidden">

    <!-- Topbar khusus perangkat Mobile -->
    <div
        class="p-4 md:hidden flex justify-between items-center bg-white shadow-xs border-b border-gray-200 relative z-30">
        <span class="font-bold text-gray-800">MyDashboard</span>
        <button id="mobile-toggle" class="text-gray-600 p-1 hover:text-gray-900 focus:outline-hidden cursor-pointer">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>
    </div>

    <!-- Container Utama App -->
    <div class="flex h-screen w-screen overflow-hidden relative">
        <!-- Backdrop Mobile Layer Overlay -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden"></div>

        <!-- Komponen Sidebar -->
        <x-sidebar />

        <!-- Area Kanan: Topbar Desktop + Content View (Menggunakan w-full demi fleksibilitas transisi) -->
        <div class="flex-1 flex flex-col min-w-0 h-full relative z-10 w-full">

            <!-- Topbar Desktop -->
            <header
                class="hidden md:flex h-16 bg-white border-b border-gray-200 items-center px-6 justify-between shrink-0 relative z-20">
                <div class="flex items-center">
                    <button id="desktop-toggle"
                        class="text-gray-500 hover:text-gray-700 p-2 hover:bg-gray-100 rounded-lg transition-colors focus:outline-hidden cursor-pointer flex items-center justify-center relative z-30"
                        style="pointer-events: auto;" title="Sembunyikan Sidebar">
                        <!-- Ikon Toggle Sidebar (Garis Tiga Kiri) -->
                        <svg class="w-5 h-5" style="pointer-events: none;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h12M4 18h16"></path>
                        </svg>
                    </button>
                </div>

                <div class="flex items-center space-x-4">
                    <span class="text-sm font-medium text-gray-600">Administrator</span>
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
