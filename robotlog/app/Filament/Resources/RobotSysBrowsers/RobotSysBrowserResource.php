<?php

namespace App\Filament\Resources\RobotSysBrowsers;

use App\Filament\Resources\RobotSysBrowsers\Pages\CreateRobotSysBrowser;
use App\Filament\Resources\RobotSysBrowsers\Pages\EditRobotSysBrowser;
use App\Filament\Resources\RobotSysBrowsers\Pages\ListRobotSysBrowsers;
use App\Filament\Resources\RobotSysBrowsers\Pages\ViewRobotSysBrowser;
use App\Filament\Resources\RobotSysBrowsers\Schemas\RobotSysBrowserForm;
use App\Filament\Resources\RobotSysBrowsers\Schemas\RobotSysBrowserInfolist;
use App\Filament\Resources\RobotSysBrowsers\Tables\RobotSysBrowsersTable;
use App\Models\RobotSysBrowser;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class RobotSysBrowserResource extends Resource
{
    protected static ?string $model = RobotSysBrowser::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBox;

    protected static ?string $recordTitleAttribute = 'System Browser';

    protected static string|UnitEnum|null $navigationGroup = 'Robot Logs';

    protected static ?string $navigationLabel = 'System Browser';

    public static function form(Schema $schema): Schema
    {
        return RobotSysBrowserForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RobotSysBrowserInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RobotSysBrowsersTable::configure($table);
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
            'index' => ListRobotSysBrowsers::route('/'),
            'create' => CreateRobotSysBrowser::route('/create'),
            'view' => ViewRobotSysBrowser::route('/{record}'),
            'edit' => EditRobotSysBrowser::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
