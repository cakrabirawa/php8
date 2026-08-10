<?php

namespace App\Filament\Resources\RobotIsALives\Pages;

use App\Filament\Resources\RobotIsALives\RobotIsALiveResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditRobotIsALive extends EditRecord
{
    protected static string $resource = RobotIsALiveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            // DeleteAction::make(),
        ];
    }
}
