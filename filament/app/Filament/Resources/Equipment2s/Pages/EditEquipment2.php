<?php

namespace App\Filament\Resources\Equipment2s\Pages;

use App\Filament\Resources\Equipment2s\Equipment2Resource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEquipment2 extends EditRecord
{
    protected static string $resource = Equipment2Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
