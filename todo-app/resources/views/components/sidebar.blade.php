@php
    // Definisikan struktur menu secara dinamis dalam bentuk Array
    $menuGroups = [
        [
            'title' => 'MENU',
            'items' => [
                ['name' => 'Dashboard', 'icon' => 'fa-solid fa-border-all', 'badge' => null, 'hasSub' => true, 'subs' => ['Analytics', 'E-commerce v2']],
                ['name' => 'AI Assistant', 'icon' => 'fa-solid fa-robot', 'badge' => 'NEW', 'hasSub' => true, 'subs' => ['Chat Bot', 'Settings']],
                ['name' => 'E-commerce', 'icon' => 'fa-solid fa-cart-shopping', 'badge' => 'NEW', 'hasSub' => true, 'subs' => ['Products', 'Orders']],
                ['name' => 'Calendar', 'icon' => 'fa-regular fa-calendar', 'badge' => null, 'hasSub' => false, 'url' => '#'],
                ['name' => 'User Profile', 'icon' => 'fa-regular fa-user', 'badge' => null, 'hasSub' => false, 'url' => '#'],
                ['name' => 'Task', 'icon' => 'fa-regular fa-square-check', 'badge' => null, 'hasSub' => true, 'subs' => ['List View', 'Kanban']],
                ['name' => 'Forms', 'icon' => 'fa-solid fa-wpforms', 'badge' => null, 'hasSub' => true, 'subs' => ['Form Elements', 'Form Layout']],
                ['name' => 'Tables', 'icon' => 'fa-solid fa-table', 'badge' => null, 'hasSub' => true, 'subs' => ['Basic Tables', 'DataTables']],
                ['name' => 'Pages', 'icon' => 'fa-regular fa-file-lines', 'badge' => null, 'hasSub' => true, 'subs' => ['Settings', 'Pricing']],
                ['name' => 'Layouts', 'icon' => 'fa-solid fa-layer-group', 'badge' => 'NEW', 'hasSub' => true, 'subs' => ['Header Config', 'Footer Config']],
            ]
        ],
        [
            'title' => 'SUPPORT',
            'items' => [
                ['name' => 'Chat', 'icon' => 'fa-regular fa-comment-dots', 'badge' => null, 'hasSub' => false, 'url' => '#'],
                ['name' => 'Support Ticket', 'icon' => 'fa-solid fa-ticket', 'badge' => 'NEW', 'hasSub' => true, 'subs' => ['Ticket List', 'Ticket Reply']],
                ['name' => 'Email', 'icon' => 'fa-regular fa-envelope', 'badge' => null, 'hasSub' => true, 'subs' => ['Inbox', 'Compose']],
            ]
        ],
        [
            'title' => 'OTHERS',
            'items' => [
                ['name' => 'Charts', 'icon' => 'fa-solid fa-chart-simple', 'badge' => null, 'hasSub' => true, 'subs' => ['Line Chart', 'Bar Chart']],
                ['name' => 'Maps', 'icon' => 'fa-regular fa-map', 'badge' => null, 'hasSub' => true, 'subs' => ['Google Maps', 'Vector Maps']],
                ['name' => 'UI Elements', 'icon' => 'fa-solid fa-cubes', 'badge' => null, 'hasSub' => true, 'subs' => ['Alerts', 'Buttons']],
                ['name' => 'Authentication', 'icon' => 'fa-solid fa-lock', 'badge' => null, 'hasSub' => true, 'subs' => ['Sign In', 'Sign Up']],
            ]
        ]
    ];
@endphp

<aside 
    class="fixed inset-y-0 left-0 z-50 w-64 bg-[#1c2434] text-[#8a99ad] flex flex-col h-full overflow-y-auto border-r border-[#2e3a47] transition-transform duration-300 transform md:translate-x-0 md:static md:flex shrink-0 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    @click.outside="sidebarOpen = false"
>
    <!-- Logo / Brand Header di Sidebar -->
    <div class="p-6 flex items-center justify-between">
        <a href="#" class="flex items-center gap-3">
            <div class="bg-blue-600 p-1.5 rounded-md text-white flex items-center justify-center w-8 h-8">
                <i class="fa-solid fa-chart-pie text-lg"></i>
            </div>
            <span class="text-white font-bold text-xl tracking-wide">TailAdmin</span>
        </a>
        
        <!-- TOMBOL CLOSE (Hanya muncul di layar HP saat sidebar terbuka) -->
        <button @click="sidebarOpen = false" class="md:hidden text-gray-400 hover:text-white transition">
            <i class="fa-solid fa-arrow-left text-lg"></i>
        </button>
    </div>

    <!-- Navigation Container -->
    <nav class="flex-1 px-6 py-4 space-y-6 select-none">
        @foreach ($menuGroups as $group)
            <div>
                <!-- Judul Group Menu (MENU, SUPPORT, OTHERS) -->
                <span class="text-[11px] font-bold uppercase tracking-widest text-[#64748b] block mb-3.5">{{ $group['title'] }}</span>
                <ul class="space-y-1.5">
                    
                    @foreach ($group['items'] as $item)
                        {{-- Set agar Support Ticket otomatis bernilai true (terbuka bawaan), yang lain false (tertutup) --}}
                        @php $isDefaultOpen = ($item['name'] === 'Support Ticket') ? 'true' : 'false'; @endphp

                        @if ($item['hasSub'])
                            <!-- JIKA MENU MEMILIKI SUB-MENU (DROPDOWN) -->
                            <li class="space-y-1" x-data="{ isOpen: {{ $isDefaultOpen }} }">
                                <button 
                                    @click="isOpen = !isOpen" 
                                    class="w-full flex items-center justify-between p-2.5 rounded-sm text-sm transition cursor-pointer"
                                    :class="isOpen ? 'bg-[#333a48] text-white' : 'hover:bg-[#333a48] hover:text-white'"
                                >
                                    <div class="flex items-center gap-3">
                                        <i class="{{ $item['icon'] }} text-base w-5 text-center" :class="isOpen && '{{ $item['name'] }}' === 'Support Ticket' ? 'text-blue-500' : ''"></i>
                                        <span>{{ $item['name'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        @if($item['badge'])
                                            <span class="bg-[#3c4d62] text-[#3fd97f] text-[9px] font-extrabold px-1.5 py-0.5 rounded-sm">{{ $item['badge'] }}</span>
                                        @endif
                                        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" 
                                           :class="isOpen ? 'rotate-180 {{ $item['name'] === 'Support Ticket' ? 'text-blue-500' : '' }}' : 'opacity-70'"></i>
                                    </div>
                                </button>

                                <!-- Wadah Sub-menu Link -->
                                <ul class="pl-10 space-y-2 text-sm pt-1" x-show="isOpen" x-collapse x-cloak>
                                    @foreach ($item['subs'] as $sub)
                                        @php $isTicketReply = ($sub === 'Ticket Reply'); @endphp
                                        <li>
                                            <a href="#" class="block py-1 transition {{ $isTicketReply ? 'text-blue-500 font-medium' : 'hover:text-white' }}">
                                                {{ $sub }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <!-- JIKA MENU BIASA (TIDAK ADA DROPDOWN) -->
                            <li>
                                <a href="{{ $item['url'] }}" class="flex items-center gap-3 p-2.5 rounded-sm hover:bg-[#333a48] hover:text-white text-sm transition">
                                    <i class="{{ $item['icon'] }} text-base w-5 text-center"></i>
                                    <span>{{ $item['name'] }}</span>
                                </a>
                            </li>
                        @endif

                    @endforeach
                </ul>
            </div>
        @endforeach
    </nav>

    <!-- Footer Copyright -->
    <div class="p-4 border-t border-[#2e3a47] text-[11px] text-center text-[#64748b]">
        #1 Tailwind CSS Dashboard
    </div>
</aside>
