<?php

namespace App\Filament\Resources\MemberTypes\Pages;

use App\Filament\GlobalCreateRecord;
use App\Filament\Resources\MemberTypes\MemberTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMemberType extends GlobalCreateRecord
{
    protected static string $resource = MemberTypeResource::class;
}
