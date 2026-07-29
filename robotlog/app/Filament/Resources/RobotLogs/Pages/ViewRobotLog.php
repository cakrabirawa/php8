<?php

namespace App\Filament\Resources\RobotLogs\Pages;

use App\Filament\Resources\RobotLogs\RobotLogResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRobotLog extends ViewRecord
{
    protected static string $resource = RobotLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // EditAction::make(),
        ];
    }
}
