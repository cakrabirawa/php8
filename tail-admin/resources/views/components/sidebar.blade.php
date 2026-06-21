<!-- LEVEL 1: Dashboard -->
<a href="#" id="nav-link-dashboard" data-page="dashboard" @click.prevent="window.loadPage('dashboard')"
    class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-lg hover:bg-slate-800 hover:text-white transition-colors text-slate-400 min-w-0">
    <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
        </path>
    </svg>
    <span class="truncate truncate-text">Dashboard</span>
</a>

<!-- LEVEL 1: E-Commerce Accordion -->
<div x-data="{ open: false }">
    <button @click="open = !open"
        class="submenu-toggle w-full flex items-center justify-between px-4 py-2.5 text-sm font-medium rounded-lg hover:bg-slate-800 hover:text-white transition-colors focus:outline-hidden min-w-0 text-left cursor-pointer">
        <div class="flex items-center min-w-0 mr-2">
            <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            <span class="truncate truncate-text">E-Commerce</span>
        </div>
        <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transform transition-transform duration-200 shrink-0"
            fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>

    <div x-show="open" x-transition class="space-y-1 mt-1">
        <!-- LEVEL 2: Products List -->
        <a href="#" id="nav-link-products" data-page="products" @click.prevent="window.loadPage('products')"
            class="nav-link flex items-center pl-8 pr-4 py-2.5 text-sm font-medium rounded-lg hover:bg-slate-800 hover:text-white transition-colors min-w-0 text-slate-400">
            <svg class="w-5 h-5 mr-3 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
            <span class="truncate truncate-text">Products List</span>
        </a>

        <!-- LEVEL 2: Order Management Accordion -->
        <div x-data="{ childOpen: false }">
            <button @click="childOpen = !childOpen"
                class="w-full flex items-center justify-between pl-8 pr-4 py-2.5 text-sm font-medium rounded-lg hover:bg-slate-800 hover:text-white transition-colors focus:outline-hidden min-w-0 text-left cursor-pointer text-slate-400">
                <div class="flex items-center min-w-0 mr-2">
                    <svg class="w-5 h-5 mr-3 shrink-0 text-slate-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                        </path>
                    </svg>
                    <span class="truncate truncate-text">Order Management System Internals</span>
                </div>
                <svg :class="childOpen ? 'rotate-180' : ''"
                    class="w-3 h-3 transform transition-transform duration-200 shrink-0" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div x-show="childOpen" x-transition class="space-y-1 mt-1 text-slate-400">
                <!-- LEVEL 3: Active Orders -->
                <a href="#" id="nav-link-active-orders" data-page="active-orders"
                    @click.prevent="window.loadPage('active-orders')"
                    class="nav-link flex items-center pl-12 pr-4 py-2.5 text-sm font-medium rounded-lg hover:bg-slate-800 hover:text-white transition-colors min-w-0 text-slate-400">
                    <svg class="w-5 h-5 mr-3 shrink-0 text-slate-500" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="truncate truncate-text">Active Orders</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- LEVEL 1: Admin Accordion -->
<div x-data="{ adminOpen: false }">
    <button @click="adminOpen = !adminOpen"
        class="w-full flex items-center justify-between px-4 py-2.5 text-sm font-medium rounded-lg hover:bg-slate-800 hover:text-white transition-colors focus:outline-hidden min-w-0 text-left cursor-pointer">
        <div class="flex items-center min-w-0 mr-2">
            <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                </path>
            </svg>
            <span class="truncate truncate-text">Admin</span>
        </div>
        <svg :class="adminOpen ? 'rotate-180' : ''" class="w-4 h-4 transform transition-transform duration-200 shrink-0"
            fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    <div x-show="adminOpen" x-transition class="space-y-1 mt-1">
        <!-- LEVEL 2: Create User -->
        <a href="#" id="nav-link-admin-create-user" data-page="admin-create-user"
            @click.prevent="window.loadPage('admin-create-user')"
            class="nav-link flex items-center pl-8 pr-4 py-2.5 text-sm font-medium rounded-lg hover:bg-slate-800 hover:text-white transition-colors min-w-0 text-slate-400">
            <svg class="w-5 h-5 mr-3 shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM2 20a6 6 0 0112 0v1H2v-1z"></path>
            </svg>
            <span class="truncate truncate-text">Create User</span>
        </a>
    </div>
</div>
