<?php

namespace App\Filament\Resources\RobotSysBrowsers\Pages;

use App\Filament\Resources\RobotSysBrowsers\RobotSysBrowserResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRobotSysBrowser extends ViewRecord
{
    protected static string $resource = RobotSysBrowserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // EditAction::make(),
        ];
    }
}
