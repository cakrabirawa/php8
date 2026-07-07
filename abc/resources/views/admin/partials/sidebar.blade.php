<nav class="w-64 bg-slate-900 h-screen text-white p-4 fixed left-0 top-0 flex flex-col justify-between z-10 shadow-xl border-r border-slate-800">
    <div class="overflow-y-auto">
        <div class="mb-6 font-bold text-xl px-3 text-indigo-400 tracking-wide flex items-center space-x-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
            <span>Nested SPA</span>
        </div>
        
        <div class="space-y-1">
            <template x-for="menu in menus" :key="menu.id">
                <div x-data="{ open: false }">
                    
                    <!-- JIKA MENU MEMILIKI SUB-MENU (DROPDOWN) -->
                    <template x-if="menu.children && menu.children.length > 0">
                        <button @click="open = !open" 
                                class="w-full flex items-center justify-between px-4 py-2.5 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition text-left text-sm">
                            <div class="flex items-center space-x-3">
                                <span class="w-4 h-4 text-slate-400" x-html="menu.icon"></span>
                                <span x-text="menu.name"></span>
                            </div>
                            <svg class="w-4 h-4 transform transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                    </template>

                    <!-- JIKA MENU BIASA (TIDAK ADA ANAK) -->
                    <template x-if="!menu.children || menu.children.length === 0">
                        <button @click="switchPage(menu.route_name)" 
                                class="w-full flex items-center space-x-3 px-4 py-2.5 rounded-xl transition text-left text-sm"
                                :class="activePage === menu.route_name ? 'bg-indigo-600 text-white font-semibold' : 'text-slate-400 hover:bg-slate-800 hover:text-white'">
                            <span class="w-4 h-4" x-html="menu.icon"></span>
                            <span x-text="menu.name"></span>
                        </button>
                    </template>

                    <!-- LEVEL 2 DROPDOWN CONTAINER -->
                    <div x-show="open" x-cloak class="pl-6 mt-1 space-y-1 border-l border-slate-800 ml-6">
                        <template x-for="sub in menu.children" :key="sub.id">
                            <button @click="switchPage(sub.route_name)" 
                                    class="w-full flex items-center space-x-3 px-4 py-2 rounded-lg text-xs text-left transition"
                                    :class="activePage === sub.route_name ? 'text-indigo-400 font-bold bg-slate-800/50' : 'text-slate-400 hover:text-white'">
                                <span x-text="sub.name"></span>
                            </button>
                        </template>
                    </div>

                </div>
            </template>
        </div>
    </div>

    <!-- Profil Akun -->
    <div class="border-t border-slate-800 pt-4 flex items-center justify-between text-xs">
        <div class="truncate">
            <p class="font-semibold text-white" x-text="auth.name"></p>
            <p class="text-slate-500 capitalize" x-text="auth.role"></p>
        </div>
        <form method="POST" action="/logout">
            @csrf
            <button @click="handleLogout()" class="text-slate-500 hover:text-red-400 transition" title="Keluar">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            </button>
        </form>
    </div>
</nav>
