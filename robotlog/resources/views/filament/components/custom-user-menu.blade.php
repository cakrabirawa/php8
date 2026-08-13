<div x-data="{ open: false, isDark: document.documentElement.classList.contains('dark') }" 
     x-init="
        const observer = new MutationObserver(() => {
            isDark = document.documentElement.classList.contains('dark');
        });
        observer.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });
     "
     style="position: relative; display: inline-block;">

    {{-- Tombol Pemicu Bulat Menggunakan Heroicon Cog (Setting) --}}
    <button @click="open = !open" type="button"
        style="cursor: pointer; border-radius: 9999px; display: flex; height: 36px; width: 36px; align-items: center; justify-content: center; border: 1px solid rgba(156, 163, 175, 0.15); transition: all 0.2s; padding: 0;"
        class="bg-gray-100 hover:bg-gray-200 dark:bg-zinc-800 dark:hover:bg-zinc-700 text-gray-500 dark:text-zinc-400"
        onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
        <!-- SVG Heroicon Cog / Gear -->
        <svg style="height: 20px; width: 20px;" xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.43l-1.003.828c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.99l1.004.831a1.125 1.125 0 0 1 .26 1.43l-1.297 2.247a1.125 1.125 0 0 1-1.37.491l-1.216-.456c-.356-.133-.751-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.43l1.004-.83c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>
    </button>

    {{-- Kotak Dropdown Menggunakan Alpine Pendeteksi Tema --}}
    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95" id="custom-dropdown-panel"
        style="position: absolute; right: 0; z-index: 50; margin-top: 8px; width: 200px; border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -4px rgba(0,0,0,0.1); padding: 4px 0;"
        :style="{ backgroundColor: isDark ? '#18181b' : '#ffffff', borderColor: isDark ? 'rgba(255,255,255,0.1)' : 'rgba(156,163,175,0.15)' }"
        class="border">

        {{-- Item Menu 1: Profil Saya --}}
        <a href="{{ url('/admin/profile') }}"
            style="display: flex; width: 100%; align-items: center; gap: 12px; padding: 10px 14px; font-size: 14px; font-weight: 500; text-decoration: none; box-sizing: border-box; transition: all 0.2s;"
            class="text-gray-700 dark:text-zinc-200" :onmouseover="
                `this.style.backgroundColor = document.documentElement.classList.contains('dark') ? '#27313f' : '#f3f4f6';
                this.style.color = '#10b981';
                this.querySelector('svg').style.color = '#10b981';`
           " onmouseout="
                this.style.backgroundColor = 'transparent';
                this.style.color = '';
                this.querySelector('svg').style.color = '';
           ">
            <svg style="height: 18px; width: 18px; color: #9ca3af; transition: color 0.2s;" xmlns="http://w3.org"
                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
            <span>Profil Saya</span>
        </a>

        {{-- Item Menu 2: Keamanan --}}
        <a href="{{ url('/admin/security') }}"
            style="display: flex; width: 100%; align-items: center; gap: 12px; padding: 10px 14px; font-size: 14px; font-weight: 500; text-decoration: none; box-sizing: border-box; transition: all 0.2s;"
            class="text-gray-700 dark:text-zinc-200" :onmouseover="
                `this.style.backgroundColor = document.documentElement.classList.contains('dark') ? '#27313f' : '#f3f4f6';
                this.style.color = '#10b981';
                this.querySelector('svg').style.color = '#10b981';`
           " onmouseout="
                this.style.backgroundColor = 'transparent';
                this.style.color = '';
                this.querySelector('svg').style.color = '';
           ">
            <svg style="height: 18px; width: 18px; color: #9ca3af; transition: color 0.2s;" xmlns="http://w3.org"
                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751A11.956 11.956 0 0112 2.714z" />
            </svg>
            <span>Keamanan</span>
        </a>

        {{-- Garis Pembatas --}}
        <hr :style="{ margin: '4px 0', border: '0', borderTop: isDark ? '1px solid rgba(255, 255, 255, 0.1)' : '1px solid rgba(156, 163, 175, 0.15)' }">

        {{-- Tombol Aksi Keluar --}}
        {{-- Tombol Aksi Keluar (Disinkronkan dengan Logout Filament) --}}
        <form method="POST" action="{{ route('filament.admin.auth.logout') }}" style="margin: 0; padding: 0; width: 100%;">
            @csrf
            <button type="submit"
                style="display: flex; width: 100%; align-items: center; gap: 12px; padding: 10px 14px; font-size: 14px; font-weight: 500; border: none; background: transparent; cursor: pointer; box-sizing: border-box; transition: all 0.2s;"
                class="text-red-600 dark:text-red-400"
                :onmouseover="`this.style.backgroundColor = document.documentElement.classList.contains('dark') ? 'rgba(220, 38, 38, 0.1)' : '#fef2f2';`"
                onmouseout="this.style.backgroundColor = 'transparent';">
                <svg style="height: 18px; width: 18px;" xmlns="http://w3.org" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                </svg>
                <span>Keluar Sistem</span>
            </button>
        </form>
    </div>
</div>
