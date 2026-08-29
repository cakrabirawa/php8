<?php

namespace App\Filament\Resources\RobotJobLogs\Pages;

use App\Filament\Resources\RobotJobLogs\RobotJobLogResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRobotJobLogs extends ListRecords
{
    protected static string $resource = RobotJobLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //   CreateAction::make(),
        ];
    }
}
