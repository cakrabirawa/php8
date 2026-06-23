<div class="space-y-3 border-t border-slate-100 dark:border-slate-700 pt-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <!-- Avatar Dinamis Abjad -->
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
    <!-- Isi Teks Pesan Chat -->
    <div class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed pl-13">
        {!! nl2br(e($reply->message)) !!}
    </div>
</div>
