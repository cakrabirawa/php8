<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\GlobalCreateRecord;
use App\Filament\Resources\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends GlobalCreateRecord
{
    protected static string $resource = ProductResource::class;
}
