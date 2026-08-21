<?php

namespace App\Filament\Resources\RobotErrorScreenshots\Pages;

use App\Filament\Resources\RobotErrorScreenshots\RobotErrorScreenshotResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRobotErrorScreenshot extends ViewRecord
{
    protected static string $resource = RobotErrorScreenshotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //   EditAction::make(),
        ];
    }
}
