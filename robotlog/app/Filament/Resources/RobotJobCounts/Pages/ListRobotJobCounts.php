<?php

namespace App\Filament\Resources\RobotJobCounts\Pages;

use App\Filament\Resources\RobotJobCounts\RobotJobCountResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRobotJobCounts extends ListRecords
{
    protected static string $resource = RobotJobCountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
