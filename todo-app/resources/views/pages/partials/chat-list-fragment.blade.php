<!-- Bagian List Looping Pesan Chat -->
@foreach ($replies as $reply)
    <div class="space-y-3 {{ !$loop->first ? 'border-t border-slate-100 dark:border-slate-700 pt-6' : '' }}">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-white shrink-0 {{ $reply->is_admin ? 'bg-blue-600' : 'bg-emerald-600' }}">
                    {{ strtoupper(substr($reply->sender_name, 0, 1)) }}
                </div>
                <div>
                    <h4 class="font-semibold text-sm text-slate-800 dark:text-white">{{ $reply->sender_name }}</h4>
                    <p class="text-xs {{ $reply->is_admin ? 'text-blue-500 font-medium' : 'text-gray-400' }}">
                        {{ $reply->is_admin ? 'From - TailAdmin support team' : $reply->sender_email }}
                    </p>
                </div>
            </div>
            <span class="text-xs text-gray-400">{{ $reply->created_at->diffForHumans() }}</span>
        </div>
        <div class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed pl-13">
            {!! nl2br(e($reply->message)) !!}
        </div>
    </div>
@endforeach

<!-- KOTAK DESAIN TOMBOL PAGINATION LINK INTERAKTIF -->
@if ($replies->hasPages())
    <div class="border-t border-slate-100 dark:border-slate-700 pt-4 flex items-center justify-between text-sm select-none">
        <div class="text-gray-400 text-xs">
            Menampilkan {{ $replies->firstItem() }}-{{ $replies->lastItem() }} dari {{ $replies->total() }} pesan
        </div>
        <div class="flex gap-2">
            {{-- Tombol Previous --}}
            @if ($replies->onFirstPage())
                <button class="px-3 py-1.5 bg-slate-100 dark:bg-slate-800 text-gray-400 rounded-md text-xs cursor-not-allowed" disabled>Prev</button>
            @else
                <button @click="loadChatPage('{{ $replies->previousPageUrl() }}&page_only=true')" class="px-3 py-1.5 bg-white dark:bg-[#1a222c] border border-slate-200 dark:border-slate-700 hover:bg-slate-50 text-slate-700 dark:text-gray-300 rounded-md text-xs cursor-pointer transition">Prev</button>
            @endif

            {{-- Tombol Next --}}
            @if ($replies->hasMorePages())
                <button @click="loadChatPage('{{ $replies->nextPageUrl() }}&page_only=true')" class="px-3 py-1.5 bg-white dark:bg-[#1a222c] border border-slate-200 dark:border-slate-700 hover:bg-slate-50 text-slate-700 dark:text-gray-300 rounded-md text-xs cursor-pointer transition">Next</button>
            @else
                <button class="px-3 py-1.5 bg-slate-100 dark:bg-slate-800 text-gray-400 rounded-md text-xs cursor-not-allowed" disabled>Next</button>
            @endif
        </div>
    </div>
@endif
