<?php

namespace App\Filament\Resources\RobotIsALives\Pages;

use App\Filament\Resources\RobotIsALives\RobotIsALiveResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRobotIsALives extends ListRecords
{
    protected static string $resource = RobotIsALiveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
