<?php

namespace App\Filament\Resources\Equipment3s\Pages;

use App\Filament\Resources\Equipment3s\Equipment3Resource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEquipment3s extends ListRecords
{
    protected static string $resource = Equipment3Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
