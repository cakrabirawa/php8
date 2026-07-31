<?php

namespace App\Filament\Resources\RobotActivities\Pages;

use App\Filament\Resources\RobotActivities\RobotActivityResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRobotActivity extends ViewRecord
{
    protected static string $resource = RobotActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // EditAction::make(),
        ];
    }
}
