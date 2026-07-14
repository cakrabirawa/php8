<?php

namespace App\Filament\Resources\Equipment2s\Pages;

use App\Filament\Resources\Equipment2s\Equipment2Resource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEquipment2s extends ListRecords
{
    protected static string $resource = Equipment2Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
