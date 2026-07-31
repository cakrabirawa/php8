<?php

namespace App\Filament\Resources\RobotActivities\Pages;

use App\Filament\Resources\RobotActivities\RobotActivityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRobotActivities extends ListRecords
{
    protected static string $resource = RobotActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
