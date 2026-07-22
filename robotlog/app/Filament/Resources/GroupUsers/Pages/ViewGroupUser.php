<?php

namespace App\Filament\Resources\GroupUsers\Pages;

use App\Filament\Resources\GroupUsers\GroupUserResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewGroupUser extends ViewRecord
{
    protected static string $resource = GroupUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
