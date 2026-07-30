<?php

namespace App\Filament\Resources\RobotLogs;

use App\Filament\Resources\RobotLogs\Pages\CreateRobotLog;
use App\Filament\Resources\RobotLogs\Pages\EditRobotLog;
use App\Filament\Resources\RobotLogs\Pages\ListRobotLogs;
use App\Filament\Resources\RobotLogs\Pages\ViewRobotLog;
use App\Filament\Resources\RobotLogs\Schemas\RobotLogForm;
use App\Filament\Resources\RobotLogs\Schemas\RobotLogInfolist;
use App\Filament\Resources\RobotLogs\Tables\RobotLogsTable;
use App\Models\RobotLog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class RobotLogResource extends Resource
{
    protected static ?string $model = RobotLog::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Robot Pending Invoice';

    protected static string|UnitEnum|null $navigationGroup = 'Logs';

    public static function form(Schema $schema): Schema
    {
        return RobotLogForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RobotLogInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RobotLogsTable::configure($table);
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
            'index' => ListRobotLogs::route('/'),
            'create' => CreateRobotLog::route('/create'),
            'view' => ViewRobotLog::route('/{record}'),
            'edit' => EditRobotLog::route('/{record}/edit'),
        ];
    }
}
