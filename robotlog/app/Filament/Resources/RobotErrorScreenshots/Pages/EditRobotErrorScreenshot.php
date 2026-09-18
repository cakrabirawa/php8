<?php

namespace App\Filament\Resources\RobotErrorScreenshots\Pages;

use App\Filament\Resources\RobotErrorScreenshots\RobotErrorScreenshotResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditRobotErrorScreenshot extends EditRecord
{
    protected static string $resource = RobotErrorScreenshotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //   ViewAction::make(),
            //   DeleteAction::make(),
        ];
    }
}
