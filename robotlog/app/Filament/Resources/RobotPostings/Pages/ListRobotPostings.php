<?php

namespace App\Filament\Resources\RobotPostings\Pages;

use App\Filament\Resources\RobotPostings\RobotPostingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRobotPostings extends ListRecords
{
    protected static string $resource = RobotPostingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
