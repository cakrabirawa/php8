<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\GlobalCreateRecord;
use App\Filament\Resources\Categories\CategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends GlobalCreateRecord
{
    protected static string $resource = CategoryResource::class;
}
