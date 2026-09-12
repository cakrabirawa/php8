<?php

namespace App\Filament\Resources\RobotPostings\Pages;

use App\Filament\Resources\RobotPostings\RobotPostingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use ZeeshanTariq\FilamentStickyColumns\Concerns\InteractsWithStickyableColumns;

class ListRobotPostings extends ListRecords
{
    use InteractsWithStickyableColumns;

    protected static string $resource = RobotPostingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
