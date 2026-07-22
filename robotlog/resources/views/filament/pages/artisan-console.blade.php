<x-filament-panels::page>
    <div class="space-y-6">
        <!-- Tampilan Interface Tabs Visual Form Builder -->
        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
            {{ $this->form }}
        </div>

        {{-- <!-- Tampilan Kotak Terminal Hasil File yang Berhasil Terbuat -->
        <div class="space-y-2">
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Console Log Output</label>

            <!-- KOTAK PEMBUNGKUS UTAMA TERMINAL BERBASIS TAILWIND -->
            <div
                class="w-full flex flex-col bg-gray-950 dark:bg-black rounded-xl border border-gray-800 dark:border-gray-900 shadow-inner overflow-hidden">

                <!-- BAR DEKORASI JENDELA TERMINAL -->
                <div
                    class="flex items-center space-x-2 px-4 py-2 border-b border-gray-800 bg-gray-900/50 text-gray-500 text-xs select-none">
                    <span class="w-3 h-3 rounded-full bg-red-500/80"></span>
                    <span class="w-3 h-3 rounded-full bg-yellow-500/80"></span>
                    <span class="w-3 h-3 rounded-full bg-green-500/80"></span>
                    <span class="ml-2 font-sans font-medium text-gray-400">artisan-web-terminal</span>
                </div>

                <!-- TEXTAREA TAILWIND UTAMA -->
                <textarea wire:model="terminalOutput" readonly rows="8"
                    class="w-full p-4 bg-transparent text-emerald-400 font-mono text-sm border-0 focus:ring-0 focus:outline-none whitespace-pre-wrap leading-relaxed resize-y placeholder-emerald-800/50"
                    placeholder="Belum ada perintah yang dieksekusi."></textarea>
            </div>
        </div> --}}
    </div>
</x-filament-panels::page>