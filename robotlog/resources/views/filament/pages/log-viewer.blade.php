@vite('resources/css/app.css')

<x-filament-panels::page>
    <div class="h-[calc(100vh-8rem)] min-h-[32rem]">
        <div class="flex h-full flex-col overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
            <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-800">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                    Aktivitas Log Terbaru
                </h3>
                <span class="text-xs text-gray-500 dark:text-gray-400">
                    Menampilkan baris terbaru di atas
                </span>
            </div>

            <div class="flex-1 overflow-auto bg-gray-950 p-4 font-mono text-sm text-gray-200">
                <div class="space-y-3">
                    @forelse($this->getLogs() as $log)
                        @php
                            $colorClass = 'text-gray-300';
                            if (str_contains($log, '.ERROR:') || str_contains($log, 'CRITICAL')) {
                                $colorClass = 'text-red-400 font-bold';
                            } elseif (str_contains($log, '.WARNING:')) {
                                $colorClass = 'text-amber-400';
                            } elseif (str_contains($log, '.INFO:')) {
                                $colorClass = 'text-emerald-400';
                            }
                        @endphp

                        <div class="border-b border-gray-800 pb-2 last:border-0 {{ $colorClass }}">
                            {!! nl2br(e($log)) !!}
                        </div>
                    @empty
                        <div class="py-4 text-center text-gray-500">
                            Tidak ada log sistem yang tersedia.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>
