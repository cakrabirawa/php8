@php
    // Jika variabel $jsFunction ada, cetak isinya.
    // Ini untuk memastikan fungsi `loadChatPage` tersedia saat halaman dimuat via AJAX.
    if (isset($jsFunction)) {
        echo $jsFunction;
    }
@endphp
<div>
    <!-- Judul Halaman & Breadcrumbs -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Re: {{ $ticket->subject }}</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">
                Menampilkan percakapan untuk tiket
                <span class="font-mono font-semibold text-blue-600 dark:text-blue-400">{{ $ticket->ticket_id }}</span>
            </p>
        </div>
        <div class="text-sm text-gray-500 flex items-center gap-2 self-start sm:self-auto select-none">
            <a href="javascript:void(0)"
               @click="$store.spa.loadPage('/', 'Analytics - TailAdmin'); window.dispatchEvent(new CustomEvent('path-changed', { detail: { path: '/' } }));"
               class="text-slate-600 dark:text-gray-400 hover:text-blue-500 dark:hover:text-white font-medium transition cursor-pointer">
                Dashboard
            </a>
            <span class="text-gray-400 font-light">&gt;</span>
            <a href="javascript:void(0)"
               @click="$store.spa.loadPage('/ticket-list', 'Ticket List - TailAdmin'); window.dispatchEvent(new CustomEvent('path-changed', { detail: { path: '/ticket-list' } }));"
               class="text-slate-600 dark:text-gray-400 hover:text-blue-500 dark:hover:text-white font-medium transition cursor-pointer">
                Tickets
            </a>
            <span class="text-gray-400 font-light">&gt;</span>
            <span class="text-gray-400 dark:text-gray-500">Reply</span>
        </div>
    </div>

    <!-- Container Utama Chat -->
    <div class="bg-white dark:bg-[#24303f] rounded-xl border border-slate-200 dark:border-slate-700 shadow-xs mt-6">

        <!-- Header Info Tiket -->
        <div class="p-6 border-b border-slate-100 dark:border-slate-700 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-white text-lg shrink-0 bg-emerald-600">
                    {{ strtoupper(substr($ticket->customer_name, 0, 1)) }}
                </div>
                <div>
                    <h3 class="font-bold text-slate-800 dark:text-white text-base">{{ $ticket->customer_name }}</h3>
                    <p class="text-xs text-gray-400">{{ $ticket->customer_email }}</p>
                </div>
            </div>
            <div class="text-xs text-gray-400 text-left sm:text-right">
                <span class="font-semibold text-slate-600 dark:text-slate-300">Kategori:</span> {{ $ticket->category }}<br>
                <span class="font-semibold text-slate-600 dark:text-slate-300">Dibuat:</span> {{ $ticket->created_at->format('d M Y, H:i') }}
            </div>
        </div>

        <!-- Area Daftar Chat (Konten Dinamis AJAX) -->
        <div id="chat-list-container" class="p-6 space-y-6">
            @include('pages.partials.chat-list-fragment', ['replies' => $replies, 'ticket' => $ticket])
        </div>

        <!-- Form Balas Pesan -->
        <div class="p-6 border-t border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-[#1a222c]/50">
            <form
                x-data="{
                    message: '',
                    isSubmitting: false,
                    submitReply() {
                        if (this.message.trim() === '') return;
                        this.isSubmitting = true;

                        fetch('/ticket-reply/{{ $ticket->id }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').getAttribute('content'),
                                'Accept': 'text/html',
                            },
                            body: JSON.stringify({ message: this.message })
                        })
                        .then(response => response.text())
                        .then(html => {
                            const chatContainer = document.getElementById('chat-list-container').querySelector('.space-y-6');
                            chatContainer.insertAdjacentHTML('beforeend', html);
                            this.message = ''; // Kosongkan textarea
                            // Auto-scroll ke pesan baru
                            chatContainer.parentElement.scrollTop = chatContainer.parentElement.scrollHeight;
                        })
                        .catch(error => console.error('Error submitting reply:', error))
                        .finally(() => this.isSubmitting = false);
                    }
                }"
                @submit.prevent="submitReply"
            >
                <textarea
                    x-model="message"
                    @keydown.enter.prevent="submitReply()"
                    class="w-full p-3 border border-slate-200 dark:border-slate-700 rounded-lg bg-white dark:bg-[#24303f] focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition text-sm text-slate-700 dark:text-slate-300"
                    rows="3"
                    placeholder="Ketik balasan Anda di sini... (Tekan Enter untuk mengirim)"
                    :disabled="isSubmitting"
                ></textarea>
                <div class="flex justify-end mt-3">
                    <button type="submit" :disabled="isSubmitting" class="inline-flex items-center gap-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg transition shadow-xs disabled:opacity-50 disabled:cursor-not-allowed">
                        <i class="fa-solid fa-paper-plane"></i>
                        <span x-text="isSubmitting ? 'Mengirim...' : 'Kirim Balasan'"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>