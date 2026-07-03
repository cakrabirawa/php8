<div>
    <!-- Judul Halaman & Breadcrumbs -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Support Tickets</h2>
        <div class="text-sm text-gray-500 flex items-center gap-2">
            <a href="javascript:void(0)" @click="$store.spa.loadPage('/', 'Analytics - TailAdmin')" class="hover:text-blue-600">Home</a> 
            <span>&gt;</span> 
            <span class="text-slate-800 dark:text-slate-300">Ticket List</span>
        </div>
    </div>

    <!-- Container Utama Tabel Konten -->
    <div class="bg-white dark:bg-[#24303f] rounded-xl border border-slate-200 dark:border-slate-700 shadow-xs mt-6 overflow-hidden">
        
        <!-- Header Tabel & Sesi Pencarian Ringan -->
        <div class="p-6 border-b border-slate-100 dark:border-slate-700 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h3 class="font-bold text-slate-800 dark:text-white text-base">Semua Antrean Tiket Bantuan</h3>
            <span class="text-xs text-gray-400">Total: {{ $tickets->count() }} Data ditemukan</span>
        </div>

        <!-- Area Responsif Tabel Data -->
        <div class="overflow-x-auto w-full">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-[#1a222c] border-b border-slate-100 dark:border-slate-700 text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                        <th class="py-4 px-6 w-32">Ticket ID</th>
                        <th class="py-4 px-6">Customer & Subject</th>
                        <th class="py-4 px-6 w-44">Kategori</th>
                        <th class="py-4 px-6 w-36 text-center">Status</th>
                        <th class="py-4 px-6 w-32 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700 text-sm">
                    @foreach ($tickets as $item)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                            <!-- Kolom ID Tiket -->
                            <td class="py-4 px-6 font-mono font-bold text-blue-600 dark:text-blue-400">
                                {{ $item->ticket_id }}
                            </td>
                            
                            <!-- Kolom Judul & Profil Pelanggan -->
                            <td class="py-4 px-6">
                                <div class="font-semibold text-slate-800 dark:text-white">{{ $item->subject }}</div>
                                <div class="text-xs text-gray-400 mt-0.5">{{ $item->customer_name }} • {{ $item->customer_email }}</div>
                            </td>
                            
                            <!-- Kolom Kategori -->
                            <td class="py-4 px-6 text-slate-600 dark:text-slate-400">
                                {{ $item->category }}
                            </td>
                            
                            <!-- Kolom Status Badge -->
                            <td class="py-4 px-6 text-center">
                                @if ($item->status === 'In-Progress')
                                    <span class="inline-block bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                        In Progress
                                    </span>
                                @elseif ($item->status === 'Solved')
                                    <span class="inline-block bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                        Solved
                                    </span>
                                @else
                                    <span class="inline-block bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                        On Hold
                                    </span>
                                @endif
                            </td>
                            
                            <!-- Kolom Tombol Aksi Buka Tiket (Terintegrasi SPA LoadPage) -->
                            <td class="py-4 px-6 text-center">
                                <button 
                                    @click="$store.spa.loadPage('/ticket-reply', 'Ticket Reply - TailAdmin')"
                                    class="inline-flex items-center gap-1.5 text-xs font-medium text-white bg-blue-600 hover:bg-blue-700 px-3 py-1.5 rounded-md transition shadow-xs cursor-pointer"
                                >
                                    <i class="fa-regular fa-folder-open"></i> Buka
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
