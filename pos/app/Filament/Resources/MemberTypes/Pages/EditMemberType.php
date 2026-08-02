<?php

namespace App\Filament\Resources\MemberTypes\Pages;

use App\Filament\GlobalEditRecord;
use App\Filament\Resources\MemberTypes\MemberTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditMemberType extends GlobalEditRecord
{
    protected static string $resource = MemberTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
