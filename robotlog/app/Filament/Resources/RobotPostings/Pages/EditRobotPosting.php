<?php

namespace App\Filament\Resources\RobotPostings\Pages;

use App\Filament\Resources\RobotPostings\RobotPostingResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditRobotPosting extends EditRecord
{
    protected static string $resource = RobotPostingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
