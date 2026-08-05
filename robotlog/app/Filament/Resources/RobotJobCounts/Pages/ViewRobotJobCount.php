<?php

namespace App\Filament\Resources\RobotJobCounts\Pages;

use App\Filament\Resources\RobotJobCounts\RobotJobCountResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRobotJobCount extends ViewRecord
{
    protected static string $resource = RobotJobCountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // EditAction::make(),
        ];
    }
}
