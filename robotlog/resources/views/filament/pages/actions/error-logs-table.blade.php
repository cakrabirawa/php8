<div class="overflow-x-auto border border-gray-200 dark:border-gray-800 rounded-xl">
    <table class="w-full text-left border-collapse bg-white dark:bg-zinc-900">
        <thead>
            <tr class="bg-gray-50 dark:bg-zinc-800 text-xs font-semibold text-gray-600 dark:text-zinc-400 uppercase tracking-wider border-b border-gray-200 dark:border-gray-800">
                <th class="px-4 py-3">Timestamp</th>
                <th class="px-4 py-3">Batch Job ID</th>
                <th class="px-4 py-3">Company</th>
                <th class="px-4 py-3">Caption / Pesan Error</th>
                <th class="px-4 py-3 text-center">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-800 text-sm text-gray-700 dark:text-zinc-300">
            @forelse($errors as $err)
                <tr class="hover:bg-gray-50/50 dark:hover:bg-zinc-800/40 transition">
                    <td class="px-4 py-3 whitespace-nowrap font-mono text-xs">
                        {{ $err->timestamp }}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap font-medium text-gray-900 dark:text-white">
                        {{ $err->batch_job_id }}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap uppercase">
                        {{ $err->company }}
                    </td>
                    <td class="px-4 py-3 max-w-md break-words text-xs text-red-600 dark:text-red-400 font-mono bg-red-50/30 dark:bg-red-950/20 p-2 rounded">
                        {{ $err->caption ?? 'Tidak ada detail pesan error.' }}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">
                            {{ $err->status }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-6 text-center text-gray-500 dark:text-zinc-400">
                        Tidak ada riwayat error yang ditemukan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
