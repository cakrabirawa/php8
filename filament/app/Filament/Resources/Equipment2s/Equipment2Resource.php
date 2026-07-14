<?php

namespace App\Filament\Resources\Equipment2s;

use App\Filament\Resources\Equipment2s\Pages\CreateEquipment2;
use App\Filament\Resources\Equipment2s\Pages\EditEquipment2;
use App\Filament\Resources\Equipment2s\Pages\ListEquipment2s;
use App\Filament\Resources\Equipment2s\Schemas\Equipment2Form;
use App\Filament\Resources\Equipment2s\Tables\Equipment2sTable;
use App\Models\Equipment2;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class Equipment2Resource extends Resource
{
    protected static ?string $model = Equipment2::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return Equipment2Form::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return Equipment2sTable::configure($table);
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
            'index' => ListEquipment2s::route('/'),
            'create' => CreateEquipment2::route('/create'),
            'edit' => EditEquipment2::route('/{record}/edit'),
        ];
    }
}
