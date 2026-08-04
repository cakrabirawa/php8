<?php

namespace App\Filament\Resources\RobotSysBrowsers\Pages;

use App\Filament\Resources\RobotSysBrowsers\RobotSysBrowserResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditRobotSysBrowser extends EditRecord
{
    protected static string $resource = RobotSysBrowserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
