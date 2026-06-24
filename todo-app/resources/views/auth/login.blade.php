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
<body>
<div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
    <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800 dark:text-white">Sign In</h2>
        
        @if($errors->any())
            <div class="bg-red-100 text-red-600 p-2 rounded mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2 dark:text-gray-300">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full p-2 border border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm mb-2 dark:text-gray-300">Password</label>
                <input type="password" name="password" class="w-full p-2 border border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800">Login</button>
        </form>
    </div>
</div>
</body>
</html>