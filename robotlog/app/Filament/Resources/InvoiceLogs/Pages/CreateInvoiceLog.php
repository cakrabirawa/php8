<?php

namespace App\Filament\Resources\InvoiceLogs\Pages;

use App\Filament\Resources\InvoiceLogs\InvoiceLogResource;
use Filament\Resources\Pages\CreateRecord;

class CreateInvoiceLog extends CreateRecord
{
    protected static string $resource = InvoiceLogResource::class;
    protected function getHeaderActions(): array
    {
        return [
            // Kosongkan di sini untuk menghilangkan tombol "New Job Log"
        ];
    }
}
