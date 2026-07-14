<?php

namespace App\Filament\Resources\Equipment3s;

use App\Filament\Resources\Equipment3s\Pages\CreateEquipment3;
use App\Filament\Resources\Equipment3s\Pages\EditEquipment3;
use App\Filament\Resources\Equipment3s\Pages\ListEquipment3s;
use App\Filament\Resources\Equipment3s\Schemas\Equipment3Form;
use App\Filament\Resources\Equipment3s\Tables\Equipment3sTable;
use App\Models\Equipment3;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class Equipment3Resource extends Resource
{
    protected static ?string $model = Equipment3::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return Equipment3Form::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return Equipment3sTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEquipment3s::route('/'),
            'create' => CreateEquipment3::route('/create'),
            'edit' => EditEquipment3::route('/{record}/edit'),
        ];
    }
}
