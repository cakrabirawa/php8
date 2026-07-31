<?php

namespace App\Filament\Resources\RobotActivities\Pages;

use App\Filament\Resources\RobotActivities\RobotActivityResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditRobotActivity extends EditRecord
{
    protected static string $resource = RobotActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            // DeleteAction::make(),
        ];
    }
}
