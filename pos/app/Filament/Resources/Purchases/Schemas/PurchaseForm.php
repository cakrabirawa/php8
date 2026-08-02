<?php

namespace App\Filament\Resources\Purchases\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PurchaseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('purchase_number')
                    ->required()
                    ->maxLength(255),
                Select::make('supplier_id')
                    ->relationship('supplier', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                DatePicker::make('purchase_date')
                    ->required()
                    ->default(now()),
                // Kolom grand_total akan dihitung otomatis, jadi tidak perlu di form.
            ]);
    }
}
