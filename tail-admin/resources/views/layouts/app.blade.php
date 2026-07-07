<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Auth') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://bunny.net">
    <link href="https://bunny.net/css?family=figtree:400;500;600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100 text-gray-900">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-slate-900 lg:translate-x-0 lg:static lg:inset-0">
            <div class="flex items-center justify-center mt-8">
                <div class="flex items-center">
                    <svg class="w-12 h-12 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                    </svg>
                    <span class="mx-2 text-2xl font-semibold text-white">Admin</span>
                </div>
            </div>

            <!-- Container untuk menu dinamis -->
            <nav id="sidebar-nav" class="mt-10" x-data="{}" @keydown.escape.window="sidebarOpen = false">
                <!-- Menu akan diisi oleh JavaScript -->
            </nav>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Main content area where pages will be loaded -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
