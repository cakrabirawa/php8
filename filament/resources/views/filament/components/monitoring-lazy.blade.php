<div x-data="{
        loading: true,
        response: '',
        init() {
            // Memanggil fungsi Livewire di backend setelah modal terbuka
            $wire.call('fetchMonitoringDataLocal', '{{ $record->batch_job_id }}')
                .then(result => {
                    this.response = result;
                    this.loading = false;
                })
                .catch(() => {
                    this.response = 'Gagal memproses permintaan data dari server internal.';
                    this.loading = false;
                });
        }
     }" class="space-y-4 p-2">

    <!-- 🌟 SPINNER LOADING CENTER (Sudah dipaksa rata tengah secara penuh) -->
    <div x-show="loading" class="flex flex-col items-center justify-center text-center py-12 w-full"
        style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; width: 100%;">
        <x-filament::loading-indicator class="h-8 w-8 text-primary-600"
            style="width: 32px; height: 32px; margin: 0 auto;" />
        <span class="text-sm text-gray-500 dark:text-gray-400 mt-3" style="margin-top: 12px; display: block;">
            Please wait...
        </span>
    </div>

    <!-- 🌟 PANEL HASIL RESPONS -->
    <div x-show="!loading" style="display: none;"
        class="rounded-lg bg-gray-50 p-4 font-mono text-xs dark:bg-zinc-900 overflow-x-auto w-full">
        <pre class="text-gray-900 dark:text-gray-100" x-text="response"></pre>
    </div>
</div>
