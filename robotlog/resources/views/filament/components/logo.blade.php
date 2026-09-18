<div class="flex items-center gap-x-4">
    <!-- Judul Brand -->
    <div class="text-xl font-bold tracking-tight text-gray-950 dark:text-white">
        D365 Robot
    </div>

    <!-- Tombol Hamburger / Collapse Sidebar -->
    <button 
        x-data
        x-on:click="$store.sidebar.isOpen = !$store.sidebar.isOpen"
        type="button"
        class="inline-flex items-center justify-center p-1 rounded-md text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none transition"
        title="Toggle Sidebar"
    >
        <!-- Ikon Hamburger (Heroicons Bars-3) -->
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>
</div>
