<?php

namespace App\Filament\Resources\InvoiceLogs\Pages;

use App\Filament\Resources\InvoiceLogs\InvoiceLogResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditInvoiceLog extends EditRecord
{
    protected static string $resource = InvoiceLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
