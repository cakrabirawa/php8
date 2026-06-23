<div>
    <!-- Judul Halaman & Breadcrumbs Interaktif -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Calendar Schedule</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Atur jadwal, tenggat waktu penanganan tiket, dan agenda tim Anda.</p>
        </div>
        
        <!-- PERBAIKAN: Mengaktifkan event klik AJAX pada teks breadcrumbs -->
        <div class="text-sm text-gray-500 flex items-center gap-2 self-start sm:self-auto select-none">
            <a href="javascript:void(0)" 
               @click="$store.spa.loadPage('/', 'Analytics - TailAdmin'); window.dispatchEvent(new CustomEvent('path-changed', { detail: { path: '/' } }));" 
               class="text-slate-600 dark:text-gray-400 hover:text-blue-500 dark:hover:text-white font-medium transition cursor-pointer"
            >
                Dashboard
            </a>
            <span class="text-gray-400 font-light">&gt;</span>
            <span class="text-gray-400 dark:text-gray-500">Calendar</span>
        </div>
    </div>

    <!-- Container Utama Kalender -->
    <div class="bg-white dark:bg-[#24303f] rounded-xl border border-slate-200 dark:border-slate-700 shadow-xs mt-6 overflow-hidden">
        
        <!-- Header Kontrol Bulan (Juni 2026) -->
        <div class="p-6 border-b border-slate-100 dark:border-slate-700 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <h3 class="font-bold text-slate-800 dark:text-white text-lg">Juni 2026</h3>
            </div>
            <div class="flex items-center border border-slate-200 dark:border-slate-700 rounded-lg overflow-hidden shadow-xs">
                <button class="px-3 py-1.5 bg-white dark:bg-[#24303f] hover:bg-slate-50 dark:hover:bg-slate-800 border-r border-slate-200 dark:border-slate-700 text-slate-600 dark:text-gray-400 transition cursor-pointer">
                    <i class="fa-solid fa-chevron-left text-xs"></i>
                </button>
                <button class="px-4 py-1.5 bg-white dark:bg-[#24303f] hover:bg-slate-50 dark:hover:bg-slate-800 text-sm font-medium text-slate-700 dark:text-gray-300 transition cursor-pointer">
                    Hari Ini
                </button>
                <button class="px-3 py-1.5 bg-white dark:bg-[#24303f] hover:bg-slate-50 dark:hover:bg-slate-800 border-l border-slate-200 dark:border-slate-700 text-slate-600 dark:text-gray-400 transition cursor-pointer">
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </button>
            </div>
        </div>

        <!-- Grid Nama Hari -->
        <div class="grid grid-cols-7 bg-slate-50 dark:bg-[#1a222c] border-b border-slate-100 dark:border-slate-700 text-center text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 py-3">
            <div>Sen</div>
            <div>Sel</div>
            <div>Rab</div>
            <div>Kam</div>
            <div>Jum</div>
            <div class="text-rose-500">Sab</div>
            <div class="text-rose-500">Aha</div>
        </div>

        <!-- Grid Kotak Tanggal Bulanan (Mulai dari Minggu 1) -->
        <div class="grid grid-cols-7 grid-rows-5 text-sm divide-x divide-y divide-slate-100 dark:divide-slate-700 border-b border-slate-100 dark:border-slate-700 bg-slate-100 dark:bg-[#1a222c]/50">
            <!-- Minggu 1 -->
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between">
                <span class="font-medium text-slate-700 dark:text-gray-300">1</span>
                <div class="space-y-1"></div>
            </div>
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between">
                <span class="font-medium text-slate-700 dark:text-gray-300">2</span>
                <div class="space-y-1"></div>
            </div>
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between">
                <span class="font-medium text-slate-700 dark:text-gray-300">3</span>
                <div class="space-y-1"></div>
            </div>
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between">
                <span class="font-medium text-slate-700 dark:text-gray-300">4</span>
                <div class="space-y-1"></div>
            </div>
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between">
                <span class="font-medium text-slate-700 dark:text-gray-300">5</span>
                <div class="space-y-1"></div>
            </div>
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between text-rose-500">
                <span>6</span>
                <div class="space-y-1"></div>
            </div>
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between text-rose-500">
                <span>7</span>
                <div class="space-y-1"></div>
            </div>

            <!-- Minggu 2 -->
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between">
                <span class="font-medium text-slate-700 dark:text-gray-300">8</span>
                <div class="space-y-1"></div>
            </div>
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between">
                <span class="font-medium text-slate-700 dark:text-gray-300">9</span>
                <div class="space-y-1"></div>
            </div>
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between">
                <span class="font-medium text-slate-700 dark:text-gray-300">10</span>
                <div class="space-y-1"></div>
            </div>
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between">
                <span class="font-medium text-slate-700 dark:text-gray-300">11</span>
                <div class="space-y-1"></div>
            </div>
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between">
                <span class="font-medium text-slate-700 dark:text-gray-300">12</span>
                <div class="bg-amber-500 text-white text-[10px] font-semibold px-1.5 py-0.5 rounded truncate" title="Fix: Connection refused Docker">
                    ⚠️ Deadline #346521
                </div>
            </div>
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between text-rose-500">
                <span>13</span>
                <div class="space-y-1"></div>
            </div>
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between text-rose-500">
                <span>14</span>
                <div class="space-y-1"></div>
            </div>

            <!-- Minggu 3 -->
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between">
                <span class="font-medium text-slate-700 dark:text-gray-300">15</span>
                <div class="space-y-1"></div>
            </div>
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between">
                <span class="font-medium text-slate-700 dark:text-gray-300">16</span>
                <div class="space-y-1"></div>
            </div>
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between">
                <span class="font-medium text-slate-700 dark:text-gray-300">17</span>
                <div class="space-y-1"></div>
            </div>
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between">
                <span class="font-medium text-slate-700 dark:text-gray-300">18</span>
                <div class="space-y-1"></div>
            </div>
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between">
                <span class="font-medium text-slate-700 dark:text-gray-300">19</span>
                <div class="space-y-1"></div>
            </div>
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between text-rose-500">
                <span>20</span>
                <div class="space-y-1"></div>
            </div>
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between text-rose-500">
                <span>21</span>
                <div class="space-y-1"></div>
            </div>
            <!-- Minggu 4 -->
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between">
                <span class="font-medium text-slate-700 dark:text-gray-300">22</span>
                <div class="space-y-1"></div>
            </div>
            <div class="bg-blue-50/30 dark:bg-blue-900/10 min-h-[100px] p-2 flex flex-col justify-between border-2 border-blue-500 rounded-sm">
                <span class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-bold shadow-xs">23</span>
                <div class="space-y-1">
                    <div class="bg-blue-600 text-white text-[10px] font-semibold px-1.5 py-0.5 rounded truncate" title="Meeting Evaluasi Sprint Seminggu">
                        💼 Evaluasi Tim
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between">
                <span class="font-medium text-slate-700 dark:text-gray-300">24</span>
                <div class="space-y-1"></div>
            </div>
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between">
                <span class="font-medium text-slate-700 dark:text-gray-300">25</span>
                <div class="space-y-1"></div>
            </div>
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between">
                <span class="font-medium text-slate-700 dark:text-gray-300">26</span>
                <div class="space-y-1"></div>
            </div>
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between text-rose-500">
                <span>27</span>
                <div class="space-y-1"></div>
            </div>
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between text-rose-500">
                <span>28</span>
                <div class="space-y-1"></div>
            </div>

            <!-- Minggu 5 -->
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between">
                <span class="font-medium text-slate-700 dark:text-gray-300">29</span>
                <div class="space-y-1"></div>
            </div>
            <div class="bg-white dark:bg-[#24303f] min-h-[100px] p-2 flex flex-col justify-between">
                <span class="font-medium text-slate-700 dark:text-gray-300">30</span>
                <div class="space-y-1"></div>
            </div>
            <!-- Tanggal Abu-abu untuk bulan berikutnya (Juli) -->
            <div class="bg-slate-50/50 dark:bg-[#1e2732]/30 min-h-[100px] p-2 text-gray-400 dark:text-gray-600">
                <span>1</span>
            </div>
            <div class="bg-slate-50/50 dark:bg-[#1e2732]/30 min-h-[100px] p-2 text-gray-400 dark:text-gray-600">
                <span>2</span>
            </div>
            <div class="bg-slate-50/50 dark:bg-[#1e2732]/30 min-h-[100px] p-2 text-gray-400 dark:text-gray-600">
                <span>3</span>
            </div>
            <div class="bg-slate-50/50 dark:bg-[#1e2732]/30 min-h-[100px] p-2 text-gray-400 dark:text-gray-600">
                <span>4</span>
            </div>
            <div class="bg-slate-50/50 dark:bg-[#1e2732]/30 min-h-[100px] p-2 text-gray-400 dark:text-gray-600">
                <span>5</span>
            </div>

        </div>
    </div>
</div>
