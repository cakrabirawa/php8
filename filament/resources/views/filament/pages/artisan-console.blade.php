<x-filament-panels::page>
    <div class="space-y-6">
        <!-- Tampilan Interface Tabs Visual Form Builder -->
        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
            {{ $this->form }}
        </div>

        <!-- Tampilan Kotak Terminal Hasil File yang Berhasil Terbuat -->
        <div class="space-y-2">
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Console Log Output</label>

            <!-- STYLING BARU UNTUK KOTAK TERMINAL -->
            <div
                class="w-full p-4 bg-gray-950 dark:bg-black text-emerald-400 font-mono text-sm rounded-xl overflow-x-auto border border-gray-800 dark:border-gray-900 shadow-inner min-h-[180px] whitespace-pre-wrap leading-relaxed">
                <div
                    class="flex items-center space-x-2 mb-3 border-b border-gray-800 pb-2 text-gray-500 text-xs select-none">
                    <span class="w-3 h-3 rounded-full bg-red-500/80"></span>
                    <span class="w-3 h-3 rounded-full bg-yellow-500/80"></span>
                    <span class="w-3 h-3 rounded-full bg-green-500/80"></span>
                    <span class="ml-2 font-sans font-medium">artisan-web-terminal</span>
                </div>
                {{ $terminalOutput }}
            </div>
        </div>
    </div>
</x-filament-panels::page>