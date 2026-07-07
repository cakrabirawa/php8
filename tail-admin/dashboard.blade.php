<x-app-layout>
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

            <nav class="mt-10" x-data="{}" @keydown.escape.window="sidebarOpen = false">
                <a id="nav-link-dashboard" href="#" @click.prevent="loadPage('dashboard'); sidebarOpen = false"
                    class="nav-link flex items-center w-full p-2 mt-4 rounded-lg text-slate-400 hover:bg-slate-800 hover:text-white group">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                    <span class="ms-3">Dashboard</span>
                </a>

                <a id="nav-link-products" href="#" @click.prevent="loadPage('products'); sidebarOpen = false"
                    class="nav-link flex items-center w-full p-2 mt-4 rounded-lg text-slate-400 hover:bg-slate-800 hover:text-white group">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path></svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Products</span>
                </a>

                <a id="nav-link-active-orders" href="#" @click.prevent="loadPage('active-orders'); sidebarOpen = false"
                    class="nav-link flex items-center w-full p-2 mt-4 rounded-lg text-slate-400 hover:bg-slate-800 hover:text-white group">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM5 11a1 1 0 100 2h4a1 1 0 100-2H5z"></path></svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Active Orders</span>
                </a>

                <a id="nav-link-admin/create-user" href="#" @click.prevent="loadPage('admin/create-user'); sidebarOpen = false"
                    class="nav-link flex items-center w-full p-2 mt-4 rounded-lg text-slate-400 hover:bg-slate-800 hover:text-white group">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Create User</span>
                </a>

                <!-- Logout Link -->
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); this.closest('form').submit();"
                       class="nav-link flex items-center w-full p-2 rounded-lg text-slate-400 hover:bg-slate-800 hover:text-white group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"/>
                        </svg>
                        <span class="ms-3 whitespace-nowrap">Keluar</span>
                    </a>
                </form>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Navbar -->
            <header class="flex justify-between items-center p-4 bg-white border-b">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>
                    <h1 class="text-xl font-semibold text-gray-700 ml-4">Dashboard</h1>
                </div>

                <div class="flex items-center">
                    <span class="text-gray-700 mr-4">Welcome, {{ Auth::user()->name }}</span>
                </div>
            </header>

            <!-- Main content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-4 md:p-6">
                <div id="content-area">
                    @include('partials.dashboard')
                </div>
            </main>
        </div>
    </div>
</x-app-layout>