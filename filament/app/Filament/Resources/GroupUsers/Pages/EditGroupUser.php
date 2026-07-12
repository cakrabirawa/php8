<?php

namespace App\Filament\Resources\GroupUsers\Pages;

use App\Filament\Resources\GroupUsers\GroupUserResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditGroupUser extends EditRecord
{
    protected static string $resource = GroupUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
