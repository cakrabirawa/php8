<!-- PERBAIKAN STRUKTUR ASIDE: Menggunakan transisi margin-left (-ml-64) untuk efek Desktop Show/Hide -->
<!-- PERBAIKAN: Mengganti ease-in-out dengan kurva cubic-bezier khusus untuk efek pantulan (bounce) -->
<aside id="sidebar"
    class="fixed inset-y-0 left-0 w-64 bg-slate-900 text-slate-300 transform -translate-x-full md:translate-x-0 md:static transition-[margin-left,transform] duration-500 ease-[cubic-bezier(0.34,1.56,0.64,1)] z-50 flex flex-col h-full shadow-lg shrink-0">

    <!-- Sidebar Header Brand -->
    <div
        class="h-16 flex items-center justify-between px-6 bg-slate-950 text-white font-bold text-xl border-b border-slate-800">
        <div class="flex items-center space-x-2">
            <svg class="w-6 h-6 text-indigo-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4">
                </path>
            </svg>
            <span>BrandAdmin</span>
        </div>
        <button id="sidebar-close" class="md:hidden text-slate-400 hover:text-white focus:outline-hidden">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Daftar Link Menu Navigasi -->
    <nav class="flex-1 overflow-y-auto p-4 space-y-1">

        <!-- LEVEL 1 -->
        <a href="#" data-page="dashboard"
            class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-lg hover:bg-slate-800 hover:text-white transition-colors bg-slate-800 text-white min-w-0">
            <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                </path>
            </svg>
            <span class="truncate truncate-text">Dashboard</span>
        </a>

        <div>
            <button
                class="submenu-toggle w-full flex items-center justify-between px-4 py-2.5 text-sm font-medium rounded-lg hover:bg-slate-800 hover:text-white transition-colors focus:outline-hidden min-w-0">
                <div class="flex items-center min-w-0 mr-2">
                    <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span class="truncate truncate-text">E-Commerce</span>
                </div>
                <svg class="arrow-icon w-4 h-4 transform transition-transform duration-200 shrink-0" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div class="submenu-content hidden space-y-1 mt-1">

                <!-- LEVEL 2 -->
                <a href="#" data-page="products"
                    class="nav-link flex items-center pl-8 pr-4 py-2.5 text-sm font-medium rounded-lg hover:bg-slate-800 hover:text-white transition-colors min-w-0">
                    <svg class="w-5 h-5 mr-3 shrink-0 text-slate-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <span class="truncate truncate-text">Products List</span>
                </a>

                <div>
                    <button
                        class="submenu-toggle w-full flex items-center justify-between pl-8 pr-4 py-2.5 text-sm font-medium rounded-lg hover:bg-slate-800 hover:text-white transition-colors focus:outline-hidden min-w-0">
                        <div class="flex items-center min-w-0 mr-2">
                            <svg class="w-5 h-5 mr-3 shrink-0 text-slate-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                </path>
                            </svg>
                            <span class="truncate truncate-text">Order Management System Internals</span>
                        </div>
                        <svg class="arrow-icon w-3 h-3 transform transition-transform duration-200 shrink-0" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <!-- LEVEL 3 -->
                    <div class="submenu-content hidden space-y-1 mt-1 text-slate-400">
                        <a href="#" data-page="active-orders"
                            class="nav-link flex items-center pl-12 pr-4 py-2.5 text-sm font-medium rounded-lg hover:bg-slate-800 hover:text-white transition-colors min-w-0">
                            <svg class="w-5 h-5 mr-3 shrink-0 text-slate-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0">
                                </path>
                            </svg>
                            <span class="truncate truncate-text">Active Orders</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </nav>
</aside>
