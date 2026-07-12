<?php

namespace App\Filament\Resources\GroupUsers\Pages;

use App\Filament\Resources\GroupUsers\GroupUserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGroupUser extends CreateRecord
{
    protected static string $resource = GroupUserResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
