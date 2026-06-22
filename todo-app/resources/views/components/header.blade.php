<header class="bg-white dark:bg-[#24303f] border-b border-[#e2e8f0] dark:border-slate-700 sticky top-0 z-35 shrink-0 select-none">
    
    <!-- ================= BARIS 1: UTAMA & MOBILE HEADER ================= -->
    <div class="h-16 flex items-center justify-between px-6 relative">
        <!-- Kiri: Tombol Toggle & Search Bar Desktop -->
        <div class="flex items-center gap-4 flex-1 max-w-md">
            <!-- TOMBOL TOGGLE SIDEBAR -->
            <button 
                @click.stop="sidebarOpen = !sidebarOpen" 
                class="flex items-center justify-center w-10 h-10 bg-white dark:bg-[#24303f] border border-gray-200 dark:border-slate-700 rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-slate-800 cursor-pointer transition shadow-xs shrink-0"
            >
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h10M4 18h16"/>
                </svg>
            </button>

            <!-- INPUT PENCARIAN -->
            <div class="hidden md:flex items-center gap-3 w-full border border-gray-200 dark:border-slate-700 rounded-lg px-3 py-1.5 bg-white dark:bg-[#1a222c] focus-within:border-blue-500 transition">
                <i class="fa-solid fa-magnifying-glass text-gray-400 shrink-0 text-sm"></i>
                <input type="text" placeholder="Search or type command..." class="w-full bg-transparent border-none text-sm outline-none text-gray-600 dark:text-gray-300">
            </div>
        </div>

        <!-- Tengah: Logo TailAdmin (Hanya Muncul di Mobile) -->
        <div class="flex md:hidden items-center gap-2.5 absolute left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2">
            <div class="bg-blue-600 p-1.5 rounded-md text-white flex items-center justify-center w-7 h-7">
                <i class="fa-solid fa-chart-pie text-sm"></i>
            </div>
            <span class="text-[#1c2434] dark:text-white font-bold text-lg tracking-wide">TailAdmin</span>
        </div>
        <!-- Kanan: Actions & Profile Dropdown (Tampilan Desktop) -->
        <div class="hidden md:flex items-center gap-5 shrink-0" x-data="{ profileOpen: false }">
            <!-- Dark Mode Toggle -->
            <button @click.stop="darkMode = !darkMode" class="text-gray-500 hover:text-gray-700 dark:text-[#aebbc8] dark:hover:text-white text-lg cursor-pointer transition">
                <i class="fa-regular transition-all duration-200" :class="darkMode ? 'fa-sun text-amber-500' : 'fa-moon'"></i>
            </button>
            
            <!-- Notification Toggle -->
            <button class="text-gray-500 hover:text-gray-700 dark:text-[#aebbc8] dark:hover:text-white text-lg relative">
                <i class="fa-regular fa-bell"></i>
                <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>
            
            <!-- PROFIL CONTAINER UTAMA -->
            <div class="relative block text-left">
                <button 
                    @click.stop="profileOpen = !profileOpen" 
                    class="flex items-center gap-3 border-l border-gray-200 dark:border-slate-700 pl-5 cursor-pointer group py-2"
                >
                    <img src="https://unsplash.com" alt="Avatar" class="w-9 h-9 rounded-full object-cover shrink-0">
                    <span class="text-sm font-semibold dark:text-white group-hover:text-blue-500 transition">Musharof</span>
                    <i class="fa-solid fa-chevron-down text-xs text-gray-400 transition-transform duration-200" :class="profileOpen ? 'rotate-180 text-blue-500' : ''"></i>
                </button>

                <!-- DROPDOWN KOTAK DESKTOP -->
                <div 
                    x-show="profileOpen" 
                    @click.outside="profileOpen = false"
                    x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 transform scale-95 translate-y-2"
                    x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
                    x-transition:leave-end="opacity-0 transform scale-95 translate-y-2"
                    class="absolute right-0 top-full mt-2 w-72 bg-white dark:bg-[#24303f] border border-gray-200 dark:border-slate-700 rounded-xl shadow-xl py-5 px-6 z-50 origin-top-right text-left"
                    style="display: none;"
                >
                    <div class="mb-4">
                        <h4 class="font-bold text-base text-slate-800 dark:text-white leading-tight">Musharof Chowdhury</h4>
                        <p class="text-xs text-gray-400 mt-0.5">randomuser@pimjo.com</p>
                    </div>
                    <div class="border-t border-gray-100 dark:border-slate-700 my-3"></div>
                    <ul class="space-y-1 text-sm text-slate-600 dark:text-slate-300">
                        <li>
                            <a href="#" class="flex items-center gap-3 py-2 px-1 hover:text-blue-500 dark:hover:text-white transition">
                                <i class="fa-regular fa-user w-5 text-center text-gray-400"></i> Edit profile
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-3 py-2 px-1 hover:text-blue-500 dark:hover:text-white transition">
                                <i class="fa-solid fa-gear w-5 text-center text-gray-400"></i> Account settings
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-3 py-2 px-1 hover:text-blue-500 dark:hover:text-white transition">
                                <i class="fa-regular fa-circle-question w-5 text-center text-gray-400"></i> Support
                            </a>
                        </li>
                    </ul>
                    <div class="border-t border-gray-100 dark:border-slate-700 my-3"></div>
                    <a href="#" class="flex items-center gap-3 py-2 px-1 text-sm text-slate-600 dark:text-slate-300 hover:text-rose-500 transition">
                        <i class="fa-solid fa-arrow-right-from-bracket w-5 text-center text-gray-400"></i> Sign out
                    </a>
                </div>
            </div>
        </div>

        <!-- Tombol Titik Tiga Kanan (Hanya Muncul di Mobile) -->
        <div class="flex md:hidden items-center shrink-0" x-data="{ subMenuOpen: false }">
            <button @click.stop="subMenuOpen = !subMenuOpen" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-white text-xl p-2 cursor-pointer">
                <i class="fa-solid fa-ellipsis"></i>
            </button>
            <div x-init="$watch('subMenuOpen', value => $dispatch('toggle-sub-bar', { open: value }))"></div>
        </div>
    </div>
    <!-- ================= BARIS 2: SUB-HEADER ACTIONS (Khusus Mobile) ================= -->
    <div 
        class="md:hidden border-t border-[#e2e8f0] dark:border-slate-700 px-6 py-3 bg-slate-50 dark:bg-[#1a222c] flex items-center justify-between transition-all duration-300 relative"
        x-data="{ isOpen: false }"
        @toggle-sub-bar.window="isOpen = $event.detail.open"
        x-show="isOpen"
        x-collapse
        x-cloak
    >
        <!-- Grup Ikon Kiri Mobile: Dark Mode & Bell Bulat -->
        <div class="flex items-center gap-4">
            <button @click="darkMode = !darkMode" class="w-10 h-10 bg-white dark:bg-[#24303f] border border-gray-200 dark:border-slate-700 rounded-full flex items-center justify-center text-gray-500 dark:text-gray-400 cursor-pointer shadow-xs">
                <i class="fa-regular" :class="darkMode ? 'fa-sun text-amber-500' : 'fa-moon'"></i>
            </button>
            <button class="w-10 h-10 bg-white dark:bg-[#24303f] border border-gray-200 dark:border-slate-700 rounded-full flex items-center justify-center text-gray-500 dark:text-gray-400 relative shadow-xs">
                <i class="fa-regular fa-bell"></i>
                <span class="absolute top-2.5 right-2.5 w-2 h-2 bg-amber-500 rounded-full"></span>
            </button>
        </div>

        <!-- Bagian Kanan Mobile: Menu Utama Profil -->
        <div class="relative inline-block text-left" x-data="{ mobileProfileOpen: false }">
            <button @click.stop="mobileProfileOpen = !mobileProfileOpen" class="flex items-center gap-2 cursor-pointer py-1">
                <img src="https://unsplash.com" alt="Avatar" class="w-8 h-8 rounded-full object-cover shrink-0">
                <span class="text-sm font-semibold dark:text-white">Musharof</span>
                <i class="fa-solid fa-chevron-down text-xs text-gray-400 transition-transform" :class="mobileProfileOpen ? 'rotate-180' : ''"></i>
            </button>

            <!-- PERBAIKAN: Mengubah posisi dari 'bottom-12' menjadi 'top-full mt-2' agar lurus ke bawah di mobile -->
            <div 
                x-show="mobileProfileOpen" 
                @click.outside="mobileProfileOpen = false"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="opacity-0 transform scale-95 translate-y-1"
                x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                class="absolute right-0 top-full mt-2 w-64 bg-white dark:bg-[#24303f] border border-gray-200 dark:border-slate-700 rounded-xl shadow-xl py-4 px-5 z-50 text-left"
                style="display: none;"
            >
                <div class="mb-2">
                    <h4 class="font-bold text-sm text-slate-800 dark:text-white">Musharof Chowdhury</h4>
                    <p class="text-[11px] text-gray-400">randomuser@pimjo.com</p>
                </div>
                <div class="border-t border-gray-100 dark:border-slate-700 my-2"></div>
                <ul class="space-y-1 text-xs text-slate-600 dark:text-slate-300">
                    <li><a href="#" class="block py-1.5 hover:text-blue-500 transition"><i class="fa-regular fa-user mr-2"></i> Edit profile</a></li>
                    <li><a href="#" class="block py-1.5 hover:text-blue-500 transition"><i class="fa-solid fa-gear mr-2"></i> Account settings</a></li>
                </ul>
            </div>
        </div>
    </div>

</header>
