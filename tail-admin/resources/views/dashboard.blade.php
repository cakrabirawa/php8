<x-app-layout>
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
    <div class="p-4 md:p-6" id="content-area">
        @include('partials.dashboard')
    </div>
</x-app-layout>
