<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Actions\Action;
use UnitEnum;
use BackedEnum;
use Filament\Support\Icons\Heroicon;

class LaporanStimulsoft extends Page
{
    // Menggunakan ikon grafik laporan sesuai keinginan Anda
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // Nama menu yang tampil di sidebar kiri
    protected static ?string $navigationLabel = 'Laporan Stimulsoft';

    // Memasukkan halaman ini ke dalam kelompok grup Master Data Anda
    protected static string|UnitEnum|null $navigationGroup = 'Master Data';

    // Urutan posisi menu di sidebar
    protected static ?int $navigationSort = 5;

    protected string $view = 'filament.pages.laporan-stimulsoft';

    protected function getActions(): array
    {
        return [
            $this->bukaReportAction(),
        ];
    }

    // Pendefinisian Modal Tailwind bawaan Filament
    public function bukaReportAction(): Action
    {
        return Action::make('bukaReport')
            ->modalHeading('Penampil Laporan Stimulsoft.JS')
            ->modalWidth('7xl')
            ->modalSubmitAction(false)
            ->modalCancelActionLabel('Tutup')
            ->modalContent(view('viewer-modal'));
    }
}
