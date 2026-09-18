<?php

namespace App\Filament\Resources\InvoiceLogs\Pages;

use App\Filament\Resources\InvoiceLogs\InvoiceLogResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInvoiceLogs extends ListRecords
{
    protected static string $resource = InvoiceLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
