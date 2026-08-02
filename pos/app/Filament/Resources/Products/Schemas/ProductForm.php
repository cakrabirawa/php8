<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('barcode'),
                TextInput::make('name')
                    ->required(),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->required(),
                TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('cost_price')
                    ->label('Cost price')
                    ->required()
                    ->prefix('Rp')
                    // Mengaktifkan fitur masking angka/uang interaktif saat mengetik
                    // Format: $money($input, 'pemisah_desimal', 'pemisah_ribuan', jumlah_desimal)
                    ->extraAlpineAttributes([
                        'x-mask:dynamic' => "\$money(\$input)",
                    ])
                    // Memastikan data yang dikirim ke database SQLite kembali berupa angka murni (tanpa titik)
                    ->dehydrateStateUsing(fn($state) => (int) str_replace('.', '', $state)),

                TextInput::make('selling_price')
                    ->label('Selling price')
                    ->required()
                    ->prefix('Rp')
                    ->extraAlpineAttributes([
                        'x-mask:dynamic' => "\$money(\$input)",
                    ])
                    ->dehydrateStateUsing(fn($state) => (int) str_replace('.', '', $state)),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
