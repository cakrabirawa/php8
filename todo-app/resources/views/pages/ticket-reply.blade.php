<div>
    <!-- Judul Halaman & Breadcrumbs -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Support Ticket reply</h2>
        <div class="text-sm text-gray-500 flex items-center gap-2">
            <a href="javascript:void(0)" @click="$store.spa.loadPage('/', 'Analytics - TailAdmin')" class="hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">Home</a> 
            <span>&gt;</span> 
            <span class="text-slate-800 dark:text-slate-300">Support Ticket reply</span>
        </div>
    </div>

    <!-- Layout 2 Kolom Dinamis (Wide) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start mt-6">
        
        <!-- ================= KOLOM KIRI: THREAD CHAT PERCAKAPAN ================= -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Boks Utama Chat dengan dukungan Dark Mode -->
            <div class="bg-white dark:bg-[#24303f] rounded-xl shadow-xs border border-slate-200 dark:border-slate-700 p-6 space-y-6">
                
                <!-- Info Header Tiket -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-slate-100 dark:border-slate-700 pb-4 gap-2">
                    <div>
                        <h3 class="font-bold text-lg text-slate-800 dark:text-white">
                            Ticket {{ $ticket->ticket_id }} - {{ $ticket->subject }}
                        </h3>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">
                            Dibuat pada: {{ $ticket->created_at->format('D, M d, Y - H:i') }}
                        </p>
                    </div>
                </div>

                <!-- TARGET REAKTIF BOKS PAGING CHAT -->
                <div class="space-y-6 transition-opacity duration-200">
                    {{-- Kontainer ini hanya untuk daftar pesan yang akan diperbarui oleh AJAX --}}
                    <div id="chat-list-container" class="space-y-6">
                        @foreach ($replies as $reply)
                            <div class="space-y-3 {{ !$loop->first ? 'border-t border-slate-100 dark:border-slate-700 pt-6' : '' }}">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <!-- Avatar Dinamis -->
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shrink-0 {{ $reply->is_admin ? 'bg-blue-600' : 'bg-emerald-600' }}">
                                            {{ strtoupper(substr($reply->sender_name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-sm text-slate-800 dark:text-white">{{ $reply->sender_name }}</h4>
                                            <p class="text-xs {{ $reply->is_admin ? 'text-blue-500 font-medium' : 'text-gray-400 dark:text-gray-500' }}">
                                                {{ $reply->is_admin ? 'From - TailAdmin support team' : $reply->sender_email }}
                                            </p>
                                        </div>
                                    </div>
                                    <span class="text-xs text-gray-400 dark:text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                                </div>
                                
                                <!-- Isi Pesan Chat -->
                                <div class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed pl-13">
                                    {!! nl2br(e($reply->message)) !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- KOTAK NAVIGATION PAGING CHAT (DIPINDAHKAN KE LUAR) -->
                @if ($replies->hasPages())
                    <div class="border-t border-slate-100 dark:border-slate-700 pt-4 flex items-center justify-between text-sm select-none">
                        <div class="text-gray-400 dark:text-gray-500 text-xs">
                            Menampilkan {{ $replies->firstItem() }}-{{ $replies->lastItem() }} dari {{ $replies->total() }} pesan
                        </div>
                        <div class="flex gap-2">
                            @if ($replies->onFirstPage())
                                <button class="px-3 py-1.5 bg-slate-100 dark:bg-slate-800 text-gray-400 dark:text-gray-600 rounded-md text-xs cursor-not-allowed" disabled>Prev</button>
                            @else
                                <button @click="loadChatPage('{{ $replies->previousPageUrl() }}&page_only=true')" class="px-3 py-1.5 bg-white dark:bg-[#1a222c] border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-gray-300 rounded-md text-xs cursor-pointer transition">Prev</button>
                            @endif

                            @if ($replies->hasMorePages())
                                <button @click="loadChatPage('{{ $replies->nextPageUrl() }}&page_only=true')" class="px-3 py-1.5 bg-white dark:bg-[#1a222c] border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-gray-300 rounded-md text-xs cursor-pointer transition">Next</button>
                            @else
                                <button class="px-3 py-1.5 bg-slate-100 dark:bg-slate-800 text-gray-400 dark:text-gray-600 rounded-md text-xs cursor-not-allowed" disabled>Next</button>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- INPUT FORM BALASAN BARU -->
                <form 
                    @submit.prevent="
                        const msg = $refs.replyMessage.value.trim();
                        if(!msg) return;
                        
                        $refs.submitBtn.disabled = true;
                        
                        fetch('/ticket-reply/{{ $ticket->id }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                                'X-Injected-Page': 'true'
                            },
                            body: JSON.stringify({ message: msg })
                        })
                        .then(res => {
                            if(!res.ok) throw new Error('Gagal mengirim balasan');
                            return res.text();
                        })
                        .then(html => {
                            document.getElementById('chat-list-container').insertAdjacentHTML('beforeend', html);
                            $refs.replyMessage.value = '';
                        })
                        .catch(err => alert(err.message))
                        .finally(() => $refs.submitBtn.disabled = false);
                    "
                    class="border border-slate-200 dark:border-slate-700 rounded-lg p-4 bg-slate-50 dark:bg-[#1a222c] mt-4"
                >
                    <textarea 
                        x-ref="replyMessage"
                        rows="4" 
                        placeholder="Type your reply here..." 
                        class="w-full bg-transparent border-none text-sm outline-none resize-none text-slate-700 dark:text-slate-300 placeholder-slate-400 focus:ring-0" 
                        required
                    ></textarea>
                    
                    <div class="flex items-center justify-between border-t border-slate-200 dark:border-slate-700 pt-3 mt-2">
                        <button type="button" class="flex items-center gap-2 text-slate-500 hover:text-slate-700 dark:text-gray-400 dark:hover:text-white text-sm font-medium">
                            <i class="fa-solid fa-paperclip"></i> Attach
                        </button>
                        <button 
                            x-ref="submitBtn"
                            type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 disabled:bg-blue-400 text-white font-medium text-sm px-5 py-2 rounded-md transition shadow-xs cursor-pointer flex items-center gap-2"
                        >
                            <span>Reply</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
        <!-- ================= KOLOM KANAN: DETAIL INFORMASI TIKET ================= -->
        <div class="bg-white dark:bg-[#24303f] rounded-xl shadow-xs border border-slate-200 dark:border-slate-700 p-6 space-y-5">
            <h4 class="font-bold text-slate-800 dark:text-white border-b border-slate-100 dark:border-slate-700 pb-3 text-base">Ticket Details</h4>
            
            <div class="space-y-4 text-sm">
                <div class="grid grid-cols-3 gap-2">
                    <span class="text-gray-400 dark:text-gray-500 font-medium">Customer</span>
                    <span class="col-span-2 text-slate-700 dark:text-slate-300 font-medium">: {{ $ticket->customer_name }}</span>
                </div>
                <div class="grid grid-cols-3 gap-2">
                    <span class="text-gray-400 dark:text-gray-500 font-medium">Email</span>
                    <span class="col-span-2 text-slate-700 dark:text-slate-300 break-all">: {{ $ticket->customer_email }}</span>
                </div>
                <div class="grid grid-cols-3 gap-2">
                    <span class="text-gray-400 dark:text-gray-500 font-medium">Ticket ID</span>
                    <span class="col-span-2 text-slate-700 dark:text-slate-300 font-mono">: {{ $ticket->ticket_id }}</span>
                </div>
                <div class="grid grid-cols-3 gap-2">
                    <span class="text-gray-400 dark:text-gray-500 font-medium">Category</span>
                    <span class="col-span-2 text-slate-700 dark:text-slate-300">: {{ $ticket->category }}</span>
                </div>
                <div class="grid grid-cols-3 gap-2 items-center">
                    <span class="text-gray-400 dark:text-gray-500 font-medium">Status</span>
                    <div class="col-span-2 flex items-center gap-1.5">
                        <span>:</span>
                        <span class="text-blue-500 bg-blue-50 dark:bg-blue-900/20 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                            {{ $ticket->status }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
