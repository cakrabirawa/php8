<?php

namespace App\Filament\Resources\RobotErrorScreenshots\Pages;

use App\Filament\Resources\RobotErrorScreenshots\RobotErrorScreenshotResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRobotErrorScreenshots extends ListRecords
{
    protected static string $resource = RobotErrorScreenshotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //   CreateAction::make(),
        ];
    }
}
