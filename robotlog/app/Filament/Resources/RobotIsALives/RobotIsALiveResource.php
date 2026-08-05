<?php

namespace App\Filament\Resources\RobotIsALives;

use App\Filament\Resources\RobotIsALives\Pages\CreateRobotIsALive;
use App\Filament\Resources\RobotIsALives\Pages\EditRobotIsALive;
use App\Filament\Resources\RobotIsALives\Pages\ListRobotIsALives;
use App\Filament\Resources\RobotIsALives\Pages\ViewRobotIsALive;
use App\Filament\Resources\RobotIsALives\Schemas\RobotIsALiveForm;
use App\Filament\Resources\RobotIsALives\Schemas\RobotIsALiveInfolist;
use App\Filament\Resources\RobotIsALives\Tables\RobotIsALivesTable;
use App\Models\RobotIsALive;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class RobotIsALiveResource extends Resource
{
    protected static ?string $model = RobotIsALive::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendar;

    protected static ?string $recordTitleAttribute = 'Robot Is Alive';

    protected static string|UnitEnum|null $navigationGroup = 'Robot Logs';

    protected static ?string $navigationLabel = 'Robot Is Alive';

    public static function form(Schema $schema): Schema
    {
        return RobotIsALiveForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RobotIsALiveInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RobotIsALivesTable::configure($table);
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
            'index' => ListRobotIsALives::route('/'),
            'create' => CreateRobotIsALive::route('/create'),
            'view' => ViewRobotIsALive::route('/{record}'),
            'edit' => EditRobotIsALive::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
