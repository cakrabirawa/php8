<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\GlobalCreateRecord;
use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends GlobalCreateRecord
{
    protected static string $resource = UserResource::class;
}
