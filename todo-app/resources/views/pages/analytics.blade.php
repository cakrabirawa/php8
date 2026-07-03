<div>
    <!-- Judul Halaman & Ringkasan -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Analytics Dashboard</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Berikut adalah ringkasan performa sistem dan antrean tiket bantuan Anda hari ini.</p>
        </div>
        <div class="text-sm text-gray-500 flex items-center gap-2 self-start sm:self-auto">
            <span class="text-slate-800 dark:text-slate-300 font-medium">Dashboard</span>
            <span>&gt;</span>
            <span class="text-gray-400">Analytics</span>
        </div>
    </div>

    <!-- ================= 1. SECTION WIDGET STATISTIK (CARDS) ================= -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
        
        <!-- Card 1: Total Tiket -->
        <div class="bg-white dark:bg-[#24303f] p-6 rounded-xl border border-slate-200 dark:border-slate-700 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-sm font-semibold text-gray-400 uppercase tracking-wider block">Total Tiket</span>
                <span class="text-3xl font-bold text-slate-800 dark:text-white block mt-1">120</span>
                <span class="text-xs text-emerald-500 font-medium inline-flex items-center gap-1 mt-2">
                    <i class="fa-solid fa-arrow-up"></i> +12% minggu ini
                </span>
            </div>
            <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-lg flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-ticket"></i>
            </div>
        </div>

        <!-- Card 2: Dalam Proses -->
        <div class="bg-white dark:bg-[#24303f] p-6 rounded-xl border border-slate-200 dark:border-slate-700 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-sm font-semibold text-gray-400 uppercase tracking-wider block">Dalam Proses</span>
                <span class="text-3xl font-bold text-amber-600 dark:text-amber-500 block mt-1">42</span>
                <span class="text-xs text-gray-400 font-medium inline-flex items-center gap-1 mt-2">
                    Sedang ditangani tim
                </span>
            </div>
            <div class="w-12 h-12 bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-500 rounded-lg flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-spinner animate-spin-slow"></i>
            </div>
        </div>
        <!-- Card 3: Selesai (Solved) -->
        <div class="bg-white dark:bg-[#24303f] p-6 rounded-xl border border-slate-200 dark:border-slate-700 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-sm font-semibold text-gray-400 uppercase tracking-wider block">Selesai</span>
                <span class="text-3xl font-bold text-emerald-600 dark:text-emerald-500 block mt-1">75</span>
                <span class="text-xs text-emerald-500 font-medium inline-flex items-center gap-1 mt-2">
                    <i class="fa-solid fa-check"></i> Tingkat kepuasan 98%
                </span>
            </div>
            <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 rounded-lg flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>

        <!-- Card 4: Waktu Respons -->
        <div class="bg-white dark:bg-[#24303f] p-6 rounded-xl border border-slate-200 dark:border-slate-700 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-sm font-semibold text-gray-400 uppercase tracking-wider block">Avg. Response</span>
                <span class="text-3xl font-bold text-indigo-600 dark:text-indigo-400 block mt-1">14m</span>
                <span class="text-xs text-emerald-500 font-medium inline-flex items-center gap-1 mt-2">
                    <i class="fa-solid fa-arrow-down"></i> 3m lebih cepat
                </span>
            </div>
            <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 rounded-lg flex items-center justify-center text-xl shrink-0">
                <i class="fa-regular fa-clock"></i>
            </div>
        </div>

    </div>

    <!-- ================= 2. SECTION GRAFIK & LIST AKTIVITAS ================= -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
        
        <!-- Kolom Kiri Luas: Contoh Representasi Grafik/Chart Placeholder -->
        <div class="lg:col-span-2 bg-white dark:bg-[#24303f] p-6 rounded-xl border border-slate-200 dark:border-slate-700 shadow-xs flex flex-col justify-between min-h-[350px]">
            <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-700 pb-4">
                <h3 class="font-bold text-slate-800 dark:text-white text-base">Grafik Tren Tiket Masuk</h3>
                <span class="text-xs text-gray-400">7 Hari Terakhir</span>
            </div>
            
            <!-- Tempat Simulasi Tampilan Chart Batang Menggunakan CSS Pure Tailwind -->
            <div class="flex items-end justify-between h-48 px-4 mt-6 gap-2 sm:gap-6">
                <div class="w-full bg-blue-500/20 dark:bg-blue-500/10 rounded-t-md relative group cursor-pointer h-[40%] hover:bg-blue-500/40">
                    <div class="absolute bottom-full left-1/2 -translate-x-1/2 bg-slate-800 text-white text-[10px] px-1.5 py-0.5 rounded opacity-0 group-hover:opacity-100 transition-opacity mb-1 z-10">12</div>
                    <span class="absolute top-full left-1/2 -translate-x-1/2 text-[10px] text-gray-400 mt-2">Sen</span>
                </div>
                <div class="w-full bg-blue-500/20 dark:bg-blue-500/10 rounded-t-md relative group cursor-pointer h-[65%] hover:bg-blue-500/40">
                    <div class="absolute bottom-full left-1/2 -translate-x-1/2 bg-slate-800 text-white text-[10px] px-1.5 py-0.5 rounded opacity-0 group-hover:opacity-100 transition-opacity mb-1 z-10">24</div>
                    <span class="absolute top-full left-1/2 -translate-x-1/2 text-[10px] text-gray-400 mt-2">Sel</span>
                </div>
                <div class="w-full bg-blue-500 rounded-t-md relative group cursor-pointer h-[90%] dark:bg-blue-600">
                    <div class="absolute bottom-full left-1/2 -translate-x-1/2 bg-slate-800 text-white text-[10px] px-1.5 py-0.5 rounded opacity-100 mb-1 z-10">45</div>
                    <span class="absolute top-full left-1/2 -translate-x-1/2 text-[10px] text-gray-400 mt-2 font-semibold text-blue-500">Rab</span>
                </div>
                <div class="w-full bg-blue-500/20 dark:bg-blue-500/10 rounded-t-md relative group cursor-pointer h-[50%] hover:bg-blue-500/40">
                    <div class="absolute bottom-full left-1/2 -translate-x-1/2 bg-slate-800 text-white text-[10px] px-1.5 py-0.5 rounded opacity-0 group-hover:opacity-100 transition-opacity mb-1 z-10">18</div>
                    <span class="absolute top-full left-1/2 -translate-x-1/2 text-[10px] text-gray-400 mt-2">Kam</span>
                </div>
                <div class="w-full bg-blue-500/20 dark:bg-blue-500/10 rounded-t-md relative group cursor-pointer h-[75%] hover:bg-blue-500/40">
                    <div class="absolute bottom-full left-1/2 -translate-x-1/2 bg-slate-800 text-white text-[10px] px-1.5 py-0.5 rounded opacity-0 group-hover:opacity-100 transition-opacity mb-1 z-10">32</div>
                    <span class="absolute top-full left-1/2 -translate-x-1/2 text-[10px] text-gray-400 mt-2">Jum</span>
                </div>
                <div class="w-full bg-blue-500/20 dark:bg-blue-500/10 rounded-t-md relative group cursor-pointer h-[30%] hover:bg-blue-500/40">
                    <div class="absolute bottom-full left-1/2 -translate-x-1/2 bg-slate-800 text-white text-[10px] px-1.5 py-0.5 rounded opacity-0 group-hover:opacity-100 transition-opacity mb-1 z-10">8</div>
                    <span class="absolute top-full left-1/2 -translate-x-1/2 text-[10px] text-gray-400 mt-2">Sab</span>
                </div>
                <div class="w-full bg-blue-500/20 dark:bg-blue-500/10 rounded-t-md relative group cursor-pointer h-[45%] hover:bg-blue-500/40">
                    <div class="absolute bottom-full left-1/2 -translate-x-1/2 bg-slate-800 text-white text-[10px] px-1.5 py-0.5 rounded opacity-0 group-hover:opacity-100 transition-opacity mb-1 z-10">15</div>
                    <span class="absolute top-full left-1/2 -translate-x-1/2 text-[10px] text-gray-400 mt-2">Aha</span>
                </div>
            </div>
            <div class="mt-4"></div>
        </div>

        <!-- Kolom Kanan Sempit: Aktivitas Terbaru (Logs) -->
        <div class="bg-white dark:bg-[#24303f] p-6 rounded-xl border border-slate-200 dark:border-slate-700 shadow-xs min-h-[350px]">
            <div class="border-b border-slate-100 dark:border-slate-700 pb-4">
                <h3 class="font-bold text-slate-800 dark:text-white text-base">Aktivitas Agen</h3>
            </div>
            
            <div class="mt-6 space-y-4">
                <!-- Log item 1 -->
                <div class="flex gap-3">
                    <div class="w-2.5 h-2.5 rounded-full bg-blue-500 mt-1.5 shrink-0"></div>
                    <div>
                        <p class="text-sm font-medium text-slate-700 dark:text-slate-300">Musharof membalas tiket <span class="font-mono font-bold text-blue-500">#346520</span></p>
                        <span class="text-xs text-gray-400 block mt-0.5">2 menit yang lalu</span>
                    </div>
                </div>
                <!-- Log item 2 -->
                <div class="flex gap-3">
                    <div class="w-2.5 h-2.5 rounded-full bg-emerald-500 mt-1.5 shrink-0"></div>
                    <div>
                        <p class="text-sm font-medium text-slate-700 dark:text-slate-300">Tiket <span class="font-mono font-bold text-blue-500">#346521</span> berhasil diselesaikan</p>
                        <span class="text-xs text-gray-400 block mt-0.5">1 jam yang lalu</span>
                    </div>
                </div>
                <!-- Log item 3 -->
                <div class="flex gap-3">
                    <div class="w-2.5 h-2.5 rounded-full bg-amber-500 mt-1.5 shrink-0"></div>
                    <div>
                        <p class="text-sm font-medium text-slate-700 dark:text-slate-300">Siti Aminah membuat tiket baru</p>
                        <span class="text-xs text-gray-400 block mt-0.5">3 jam yang lalu</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
