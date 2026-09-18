<?php

namespace App\Filament\Resources\Customers\Pages;

use App\Filament\GlobalCreateRecord;
use App\Filament\Resources\Customers\CustomerResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomer extends GlobalCreateRecord
{
    protected static string $resource = CustomerResource::class;
}
