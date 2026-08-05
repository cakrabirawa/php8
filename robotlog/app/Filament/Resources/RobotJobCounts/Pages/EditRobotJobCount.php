<?php

namespace App\Filament\Resources\RobotJobCounts\Pages;

use App\Filament\Resources\RobotJobCounts\RobotJobCountResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditRobotJobCount extends EditRecord
{
    protected static string $resource = RobotJobCountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
