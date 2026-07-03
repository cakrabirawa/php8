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
                    'badge' => 'NEW', 
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
    <nav class="flex-1 px-6 py-4 space-y-6 select-none">
        @foreach ($menuGroups as $group)
            <div>
                <span class="text-[11px] font-bold uppercase tracking-widest text-[#64748b] block mb-3.5">{{ $group['title'] }}</span>
                <ul class="space-y-1.5">
                    @foreach ($group['items'] as $item)
                        @php $isDefaultOpen = ($item['name'] === 'Support Ticket') ? 'true' : 'false'; @endphp

                        @if ($item['hasSub'])
                            <!-- MENU DROPDOWN -->
                            <li class="space-y-1" x-data="{ isOpen: {{ $isDefaultOpen }} }">
                                <button @click="isOpen = !isOpen" class="w-full flex items-center justify-between p-2.5 rounded-sm text-sm transition cursor-pointer" :class="isOpen ? 'bg-[#333a48] text-white' : 'hover:bg-[#333a48] hover:text-white'">
                                    <div class="flex items-center gap-3">
                                        <i class="{{ $item['icon'] }} text-base w-5 text-center"></i>
                                        <span>{{ $item['name'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        @if($item['badge'])
                                            <span class="bg-[#3c4d62] text-[#3fd97f] text-[9px] font-extrabold px-1.5 py-0.5 rounded-sm">{{ $item['badge'] }}</span>
                                        @endif
                                        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" :class="isOpen ? 'rotate-180' : 'opacity-70'"></i>
                                    </div>
                                </button>

                                <ul class="pl-10 space-y-2 text-sm pt-1" x-show="isOpen" x-cloak>
                                    @foreach ($item['subs'] as $sub)
                                        <li>
                                            <!-- URL dan Judul diambil langsung secara dinamis dari array -->
                                            <a href="javascript:void(0)" 
                                            @click="$store.spa.loadPage('{{ $sub['url'] }}', '{{ $sub['name'] }} - TailAdmin'); if(window.innerWidth < 768) sidebarOpen = false;"
                                            class="block py-1 transition hover:text-white"
                                            :class="window.location.pathname === '{{ $sub['url'] }}' ? 'text-blue-500 font-medium' : ''">
                                                {{ $sub['name'] }}
                                            </a>

                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <!-- MENU SINGLE LINK -->
                            <li>
                                <a href="javascript:void(0)" 
                                @click="$store.spa.loadPage('{{ $item['url'] }}', '{{ $item['name'] }} - TailAdmin'); if(window.innerWidth < 768) sidebarOpen = false;"
                                class="flex items-center gap-3 p-2.5 rounded-sm text-sm transition"
                                :class="window.location.pathname === '{{ $item['url'] }}' ? 'bg-[#333a48] text-white' : 'hover:bg-[#333a48] hover:text-white'">
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
</aside>
