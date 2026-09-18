<?php

namespace App\Filament\Resources\RobotIsALives\Pages;

use App\Filament\Resources\RobotIsALives\RobotIsALiveResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRobotIsALive extends ViewRecord
{
    protected static string $resource = RobotIsALiveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // EditAction::make(),
        ];
    }
}
