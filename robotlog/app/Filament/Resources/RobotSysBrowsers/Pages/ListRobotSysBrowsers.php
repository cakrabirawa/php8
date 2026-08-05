<?php

namespace App\Filament\Resources\RobotSysBrowsers\Pages;

use App\Filament\Resources\RobotSysBrowsers\RobotSysBrowserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRobotSysBrowsers extends ListRecords
{
    protected static string $resource = RobotSysBrowserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
