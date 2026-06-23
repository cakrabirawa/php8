@php
    $menuGroups = [
        [
            'title' => 'MENU',
            'items' => [
                [
                    'name' => 'Dashboard', 
                    'icon' => 'fa-solid fa-border-all', 
                    'badge' => null, 
                    'hasSub' => true, 
                    'subs' => [
                        ['name' => 'Analytics', 'url' => '/']
                    ]
                ],
                [
                    'name' => 'Calendar', 
                    'icon' => 'fa-regular fa-calendar', 
                    'badge' => null, 
                    'hasSub' => false, 
                    'url' => '/calendar'
                ],
            ]
        ],
        [
            'title' => 'SUPPORT',
            'items' => [
                [
                    'name' => 'Support Ticket', 
                    'icon' => 'fa-solid fa-ticket', 
                    'badge' => null, 
                    'hasSub' => true, 
                    'subs' => [
                        ['name' => 'Ticket List', 'url' => '/ticket-list'],
                        ['name' => 'Ticket Reply', 'url' => '/ticket-reply']
                    ]
                ],
            ]
        ]
    ];
@endphp

<aside class="w-64 bg-[#1c2434] text-[#8a99ad] flex flex-col h-full overflow-y-auto shrink-0 border-r border-[#2e3a47] [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
    <!-- Logo Header -->
    <div class="p-6 flex items-center justify-between">
        <a href="#" class="flex items-center gap-3">
            <div class="bg-blue-600 p-1.5 rounded-md text-white flex items-center justify-center w-8 h-8">
                <i class="fa-solid fa-chart-pie text-lg"></i>
            </div>
            <span class="text-white font-bold text-xl tracking-wide">TailAdmin</span>
        </a>
    </div>

    <!-- Navigation Container -->
    <nav 
        class="flex-1 px-6 py-4 space-y-6 select-none" 
        x-data="{ currentPath: window.location.pathname }"
        @path-changed.window="currentPath = $event.detail.path"
    >
        
        @foreach ($menuGroups as $group)
            <div>
                <span class="text-[11px] font-bold uppercase tracking-widest text-[#64748b] block mb-3.5">{{ $group['title'] }}</span>
                <ul class="space-y-1.5">
                    @foreach ($group['items'] as $item)
                        @php 
                            $hasActiveChild = false;
                            $jsUrls = []; 
                            if($item['hasSub']) {
                                foreach($item['subs'] as $sub) {
                                    $jsUrls[] = $sub['url'];
                                    if(request()->is(ltrim($sub['url'], '/'))) {
                                        $hasActiveChild = true;
                                    }
                                }
                            }
                            $isDefaultOpen = ($item['name'] === 'Support Ticket' || $hasActiveChild) ? 'true' : 'false'; 
                        @endphp

                        @if ($item['hasSub'])
                            <!-- 1. JIKA MENU DROPDOWN -->
                            <li class="space-y-1" x-data="{ isOpen: {{ $isDefaultOpen }} }" @path-changed.window="if({{ json_encode($jsUrls) }}.includes($event.detail.path)) { isOpen = true }">
                                {{-- PERBAIKAN: Menambahkan atribut title="{{ $item['name'] }}" sebagai tooltip --}}
                                <button 
                                    @click="isOpen = !isOpen" 
                                    title="{{ $item['name'] }}"
                                    class="w-full flex items-center justify-between p-2.5 rounded-md text-sm transition cursor-pointer hover:bg-[#333a48] hover:text-white min-w-0" 
                                    :class="{{ json_encode($jsUrls) }}.includes(currentPath) ? 'text-white' : ''"
                                >
                                    <div class="flex items-center gap-3 min-w-0 flex-1">
                                        <i class="{{ $item['icon'] }} text-base w-5 text-center transition-colors shrink-0" :class="{{ json_encode($jsUrls) }}.includes(currentPath) ? 'text-blue-500' : ''"></i>
                                        {{-- PERBAIKAN: Menambahkan truncate agar teks lurus satu baris dan memotong otomatis dengan ... --}}
                                        <span class="truncate pr-1">{{ $item['name'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 shrink-0">
                                        @if($item['badge'])
                                            <span class="bg-[#3c4d62] text-[#3fd97f] text-[9px] font-extrabold px-1.5 py-0.5 rounded-sm shrink-0">{{ $item['badge'] }}</span>
                                        @endif
                                        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200 shrink-0" :class="isOpen ? 'rotate-180' : 'opacity-70'", :style="{{ json_encode($jsUrls) }}.includes(currentPath) ? 'color: #3b82f6' : ''"></i>
                                    </div>
                                </button>

                                <!-- Wadah Sub-Menu Teks -->
                                <ul class="pl-6 space-y-1 text-sm pt-1" x-show="isOpen" x-collapse x-cloak>
                                    @foreach ($item['subs'] as $sub)
                                        <li>
                                            <a href="javascript:void(0)" 
                                               title="{{ $sub['name'] }}"
                                               @click="$store.spa.loadPage('{{ $sub['url'] }}', '{{ $sub['name'] }} - TailAdmin'); currentPath = '{{ $sub['url'] }}'; if(window.innerWidth < 768) sidebarOpen = false;"
                                               class="flex items-center w-full px-4 py-2 rounded-md transition min-w-0"
                                               :class="currentPath === '{{ $sub['url'] }}' ? 'bg-[#333a48] text-blue-500 font-medium' : 'text-[#8a99ad] hover:text-white'">
                                                <span class="truncate">{{ $sub['name'] }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <!-- 2. JIKA MENU BIASA / SINGLE LINK (CONTOH: CALENDAR) -->
                            <li>
                                <a href="javascript:void(0)" 
                                   title="{{ $item['name'] }}"
                                   @click="$store.spa.loadPage('{{ $item['url'] }}', '{{ $item['name'] }} - TailAdmin'); currentPath = '{{ $item['url'] }}'; if(window.innerWidth < 768) sidebarOpen = false;"
                                   class="flex items-center gap-3 p-2.5 rounded-md text-sm transition min-w-0"
                                   :class="currentPath === '{{ $item['url'] }}' ? 'bg-[#333a48] text-white' : 'hover:bg-[#333a48] hover:text-white'">
                                    <i class="{{ $item['icon'] }} text-base w-5 text-center shrink-0"></i>
                                    <span class="truncate">{{ $item['name'] }}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endforeach

    </nav>
</aside>
