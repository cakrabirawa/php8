<?php

namespace App\Filament\Resources\RobotLogs\Pages;

use App\Filament\Resources\RobotLogs\RobotLogResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditRobotLog extends EditRecord
{
    protected static string $resource = RobotLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
