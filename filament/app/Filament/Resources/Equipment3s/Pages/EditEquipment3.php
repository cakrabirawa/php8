<?php

namespace App\Filament\Resources\Equipment3s\Pages;

use App\Filament\Resources\Equipment3s\Equipment3Resource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEquipment3 extends EditRecord
{
    protected static string $resource = Equipment3Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
