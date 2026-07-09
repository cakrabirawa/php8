<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Category;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('product_name')
                    ->required()
                    ->maxLength(100),
                TextInput::make('price')
                    ->label('Price')
                    ->prefix('Rp')
                    ->mask(RawJs::make(<<<'JS'
        $money($input, '.', ',')
    JS))
                    ->stripCharacters('.')
                    ->required(),
                Select::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name') // 'category' adalah nama fungsi relasi di Model, 'name' adalah kolom yang mau ditampilkan
                    ->searchable() // Membuat pilihan bisa dicari teksnya
                    ->preload() // Memuat data di awal agar cepat saat diklik
                    ->required()
            ]);
    }
}
