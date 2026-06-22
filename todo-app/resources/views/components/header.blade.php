<header class="bg-white border-b border-[#e2e8f0] h-16 flex items-center justify-between px-6 sticky top-0 z-10 shrink-0">
    
    <!-- Bagian Kiri: Tombol Toggle & Search Bar -->
    <div class="flex items-center gap-4 flex-1 max-w-md">
        
        <!-- TOMBOL TOGGLE SIDEBAR (Selalu Muncul di Semua Ukuran Layar) -->
        <button 
            @click.stop="sidebarOpen = !sidebarOpen" 
            class="flex items-center justify-center w-10 h-10 bg-white border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50 cursor-pointer transition shadow-xs shrink-0"
        >
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h10M4 18h16"/>
            </svg>
        </button>

        <!-- Kotak Input Pencarian -->
        <div class="flex items-center gap-3 w-full border border-gray-200 rounded-lg px-3 py-1.5 bg-white focus-within:border-blue-500 transition">
            <i class="fa-solid fa-magnifying-glass text-gray-400 shrink-0 text-sm"></i>
            <input type="text" placeholder="Search or type command..." class="w-full bg-transparent border-none text-sm outline-none text-gray-600">
        </div>
    </div>

    <!-- Bagian Kanan: Actions & Profile -->
    <div class="flex items-center gap-5 shrink-0">
        <button class="text-gray-500 hover:text-gray-700 text-lg"><i class="fa-regular fa-moon"></i></button>
        <button class="text-gray-500 hover:text-gray-700 text-lg relative">
            <i class="fa-regular fa-bell"></i>
            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
        </button>
        
        <div class="flex items-center gap-3 border-l border-gray-200 pl-5">
            <div class="text-right hidden sm:block">
                <p class="text-sm font-semibold">Musharof</p>
            </div>
            <img src="https://unsplash.com" alt="Avatar" class="w-9 h-9 rounded-full object-cover">
            <i class="fa-solid fa-chevron-down text-xs text-gray-400"></i>
        </div>
    </div>
</header>
