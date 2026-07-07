<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Core Admin SPA Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <script defer src="https://jsdelivr.net"></script> --}}
</head>
<body class="bg-slate-50 font-sans text-slate-800" x-data="spaShell()" x-init="initApp()">

    <!-- JIKA BELUM LOGIN: TAMPILKAN HALAMAN LOGIN DENGAN SLIDER CAPTCHA -->
    <template x-if="!isLoggedIn">
        @include('admin.partials.view-login')
    </template>

    <!-- JIKA SUDAH LOGIN: TAMPILKAN PANEL ADMIN UTAMA -->
    <template x-if="isLoggedIn">
        <div class="flex">
            <!-- Menu Samping (Sidebar) -->
            @include('admin.partials.sidebar')

            <!-- Konten Dinamis -->
            <main class="flex-1 pl-64 p-8 min-h-screen">
                <div class="max-w-6xl mx-auto">
                    @include('admin.partials.view-users')
                    @include('admin.partials.view-access')
                </div>
            </main>

            <!-- Modal Form Standalone -->
            @include('admin.partials.modal-user')
        </div>
    </template>

    @include('admin.partials.script-js')

</body>
</html>
