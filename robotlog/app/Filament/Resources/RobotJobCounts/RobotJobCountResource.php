<?php

namespace App\Filament\Resources\RobotJobCounts;

use App\Filament\Resources\RobotJobCounts\Pages\CreateRobotJobCount;
use App\Filament\Resources\RobotJobCounts\Pages\EditRobotJobCount;
use App\Filament\Resources\RobotJobCounts\Pages\ListRobotJobCounts;
use App\Filament\Resources\RobotJobCounts\Pages\ViewRobotJobCount;
use App\Filament\Resources\RobotJobCounts\Schemas\RobotJobCountForm;
use App\Filament\Resources\RobotJobCounts\Schemas\RobotJobCountInfolist;
use App\Filament\Resources\RobotJobCounts\Tables\RobotJobCountsTable;
use App\Models\RobotJobCount;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class RobotJobCountResource extends Resource
{
    protected static ?string $model = RobotJobCount::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;

    protected static ?string $recordTitleAttribute = 'Batch Job Count';

    protected static string|UnitEnum|null $navigationGroup = 'Robot Logs';

    protected static ?string $navigationLabel = 'Batch Job Count';

    public static function form(Schema $schema): Schema
    {
        return RobotJobCountForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RobotJobCountInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RobotJobCountsTable::configure($table);
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
            'index' => ListRobotJobCounts::route('/'),
            'create' => CreateRobotJobCount::route('/create'),
            'view' => ViewRobotJobCount::route('/{record}'),
            'edit' => EditRobotJobCount::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
