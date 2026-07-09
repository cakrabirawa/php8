<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Models\Category;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(100),
                Select::make('parent_id')
                    ->label('Kategori Induk (Parent)')
                    ->relationship('parent', 'name') // Mengambil data dari relasi 'parent'
                    ->searchable()
                    ->placeholder('Pilih jika ini adalah Sub-Kategori')
                    // Keamanan: Mencegah kategori memilih dirinya sendiri saat edit
                    ->disableOptionWhen(function (?Category $record) {
                        if (! $record) return [];
                        // Kategori ini dan semua anak-anaknya tidak boleh dipilih jadi induk
                        return [$record->id];
                    }),
            ]);
    }
}
