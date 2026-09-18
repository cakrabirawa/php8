<?php

namespace App\Filament\Resources\RobotPostings\Pages;

use App\Filament\Resources\RobotPostings\RobotPostingResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRobotPosting extends ViewRecord
{
    protected static string $resource = RobotPostingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // EditAction::make(),
        ];
    }
}
