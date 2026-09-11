<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\File;
use UnitEnum;

class LogViewer extends Page
{
    // Icon menu di sidebar Filament
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBox;

    // Judul Halaman
    protected static ?string $title = 'Laravel Log Viewer';

    // Nama file blade view yang digunakan
    protected string $view = 'filament.pages.log-viewer';

    // Label menu di sidebar
    protected static ?string $navigationLabel = 'System Logs';

    // Mengelompokkan menu (opsional)
    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    /**
     * Mengambil isi file laravel.log dan memprosesnya
     */
    public function getLogs(): array
    {
        $logPath = storage_path('logs/laravel.log');

        if (! File::exists($logPath)) {
            return ['Belum ada log yang tercatat atau file laravel.log tidak ditemukan.'];
        }

        // Membaca file log per baris
        $fileContent = File::get($logPath);

        // Memisahkan baris berdasarkan timestamp log umum Laravel [YYYY-MM-DD HH:MM:SS]
        $logs = preg_split('/(?=\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\])/', $fileContent);

        // Buang baris kosong dan bersihkan spasi
        $logs = array_filter(array_map('trim', $logs));

        // Membalik urutan agar log terbaru muncul di paling atas
        return array_reverse($logs);
    }
}
