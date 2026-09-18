<?php

namespace App\Filament\Resources\Suppliers\Pages;

use App\Filament\GlobalCreateRecord;
use App\Filament\Resources\Suppliers\SupplierResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSupplier extends GlobalCreateRecord
{
    protected static string $resource = SupplierResource::class;
}
