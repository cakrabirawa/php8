<?php

namespace App\Filament\Resources\GroupUsers\Pages;

use App\Filament\Resources\GroupUsers\GroupUserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGroupUsers extends ListRecords
{
    protected static string $resource = GroupUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
