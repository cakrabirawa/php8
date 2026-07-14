<div class="flex justify-end mt-4">
    <!-- Menggunakan fitur wire:confirm bawaan Livewire demi keamanan data -->
    <x-filament::button type="button" wire:click="deleteComponents"
        wire:confirm="PERINGATAN SEBELUM MENGHAPUS: Apakah Anda benar-benar yakin? Tindakan destruktif ini akan menghapus file fisik di dalam kode proyek Anda secara permanen dan tidak bisa dibatalkan kembali!"
        color="danger" icon="heroicon-m-trash">
        Hancurkan & Hapus Komponen
    </x-filament::button>
</div>