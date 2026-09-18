<div class="flex justify-end mt-4">
    <x-filament::modal id="delete-components-modal" width="md">
        {{-- Tombol Pemicu Dialog --}}
        <x-slot name="trigger">
            <x-filament::button color="danger" icon="heroicon-m-trash">
                Hancurkan & Hapus Komponen
            </x-filament::button>
        </x-slot>

        {{-- Konten Peringatan Modal --}}
        <x-slot name="heading">
            Peringatan Sebelum Menghapus
        </x-slot>

        <x-slot name="description">
            Apakah Anda benar-benar yakin? Tindakan destruktif ini akan menghapus file fisik di dalam kode proyek Anda
            secara permanen dan tidak bisa dibatalkan kembali!
        </x-slot>

        {{-- Tombol Aksi di dalam Modal --}}
        <x-slot name="footer" class="flex justify-end gap-3">
            {{-- Tombol Batal untuk menutup modal secara otomatis --}}
            <x-filament::button color="gray" x-on:click="$dispatch('close-modal', { id: 'delete-components-modal' })">
                Batal
            </x-filament::button>

            {{-- Tombol Hapus yang memicu method di Livewire --}}
            <x-filament::button wire:click="deleteComponents" color="danger">
                Ya, Hapus Permanen
            </x-filament::button>
        </x-slot>
    </x-filament::modal>
</div>