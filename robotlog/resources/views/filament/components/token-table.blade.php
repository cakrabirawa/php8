<div class="fi-ta-ctn overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-white/10 dark:bg-zinc-900"
    style="border: 1px solid rgba(128,128,128,0.2); border-radius: 12px; width: 100%;">
    <div style="width: 100%; overflow-x: auto;">
        <table style="width: 100%; table-layout: fixed; border-collapse: collapse; text-align: left; font-size: 14px;">
            <!-- Header Tabel (Otomatis menyesuaikan warna teks berdasarkan kelas tema Filament) -->
            <thead
                class="bg-gray-50 text-gray-500 dark:bg-white/5 dark:text-gray-400 border-b border-gray-200 dark:border-white/5"
                style="font-size: 12px; font-weight: 600; text-transform: uppercase;">
                <tr>
                    <th scope="col" style="padding: 14px 24px; width: 50%;">Hash Token (SHA-256)</th>
                    <th scope="col" style="padding: 14px 24px; width: 25%; white-space: nowrap;">Terakhir Digunakan</th>
                    <th scope="col" style="padding: 14px 24px; width: 25%; white-space: nowrap;">Dibuat Pada</th>
                </tr>
            </thead>

            <!-- Body Tabel -->
            <tbody class="divide-y divide-gray-200 dark:divide-white/5">
                @php
                    $tokens = $getRecord()?->tokens ?? [];
                @endphp

                @forelse($tokens as $token)
                    <!-- Class text-gray-700 dan dark:text-gray-300 mengatur warna teks otomatis saat mode berganti -->
                    <tr class="text-gray-700 dark:text-gray-300 border-b border-gray-100 dark:border-white/5">

                        <!-- Kolom Hash Token -->
                        <td class="text-gray-600 dark:text-gray-400"
                            style="padding: 16px 24px; font-family: monospace; font-size: 12px; word-break: break-all !important; overflow-wrap: break-word !important; white-space: normal !important;">
                            {{ $token->token ?? $token->hash ?? '-' }}
                        </td>

                        <!-- Kolom Terakhir Digunakan -->
                        <td style="padding: 16px 24px; white-space: nowrap;">
                            @if($token->last_used_at)
                                <span class="bg-blue-50 text-blue-700 dark:bg-blue-500/10 dark:text-blue-400"
                                    style="display: inline-flex; align-items: center; border-radius: 6px; padding: 4px 8px; font-size: 12px; font-weight: 500; border: 1px solid rgba(96, 165, 250, 0.2);">
                                    {{ \Carbon\Carbon::parse($token->last_used_at)->translatedFormat('d M Y H:i') }}
                                </span>
                            @else
                                <span class="bg-gray-50 text-gray-600 dark:bg-white/5 dark:text-gray-400"
                                    style="display: inline-flex; align-items: center; border-radius: 6px; padding: 4px 8px; font-size: 12px; font-weight: 500; border: 1px solid rgba(128, 128, 128, 0.2);">
                                    Belum pernah
                                </span>
                            @endif
                        </td>

                        <!-- Kolom Dibuat Pada -->
                        <td class="text-gray-500 dark:text-gray-400"
                            style="font-size: 12px; padding: 16px 24px; white-space: nowrap;">
                            {{ $token->created_at ? \Carbon\Carbon::parse($token->created_at)->translatedFormat('d M Y H:i') : '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-gray-400 dark:text-gray-500" style="padding: 48px; text-align: center;">
                            Tidak ada API token aktif yang terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
