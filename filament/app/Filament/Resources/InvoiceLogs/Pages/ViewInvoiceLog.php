<?php

namespace App\Filament\Resources\InvoiceLogs\Pages;

use App\Filament\Resources\InvoiceLogs\InvoiceLogResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewInvoiceLog extends ViewRecord
{
    protected static string $resource = InvoiceLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // EditAction::make(),
        ];
    }
}
