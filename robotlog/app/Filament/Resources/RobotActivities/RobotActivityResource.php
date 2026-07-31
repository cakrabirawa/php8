<?php

namespace App\Filament\Resources\RobotActivities;

use App\Filament\Resources\RobotActivities\Pages\CreateRobotActivity;
use App\Filament\Resources\RobotActivities\Pages\EditRobotActivity;
use App\Filament\Resources\RobotActivities\Pages\ListRobotActivities;
use App\Filament\Resources\RobotActivities\Pages\ViewRobotActivity;
use App\Filament\Resources\RobotActivities\Schemas\RobotActivityForm;
use App\Filament\Resources\RobotActivities\Schemas\RobotActivityInfolist;
use App\Filament\Resources\RobotActivities\Tables\RobotActivitiesTable;
use App\Models\RobotActivity;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class RobotActivityResource extends Resource
{
    protected static ?string $model = RobotActivity::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Robot Is Still Alive';

    protected static string|UnitEnum|null $navigationGroup = 'Robot Logs';

    protected static ?string $navigationLabel = 'Robot Is Still Alive';

    public static function form(Schema $schema): Schema
    {
        return RobotActivityForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RobotActivityInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RobotActivitiesTable::configure($table);
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
            'index' => ListRobotActivities::route('/'),
            'create' => CreateRobotActivity::route('/create'),
            'view' => ViewRobotActivity::route('/{record}'),
            'edit' => EditRobotActivity::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
