<?php

namespace App\Filament\Resources\RobotJobLogs;

use App\Filament\Resources\RobotJobLogs\Pages\CreateRobotJobLog;
use App\Filament\Resources\RobotJobLogs\Pages\EditRobotJobLog;
use App\Filament\Resources\RobotJobLogs\Pages\ListRobotJobLogs;
use App\Filament\Resources\RobotJobLogs\Pages\ViewRobotJobLog;
use App\Filament\Resources\RobotJobLogs\Schemas\RobotJobLogForm;
use App\Filament\Resources\RobotJobLogs\Schemas\RobotJobLogInfolist;
use App\Filament\Resources\RobotJobLogs\Tables\RobotJobLogsTable;
use App\Models\RobotJobLog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class RobotJobLogResource extends Resource
{
    protected static ?string $model = RobotJobLog::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $recordTitleAttribute = 'job_id';

    protected static string|UnitEnum|null $navigationGroup = 'Robot Logs';

    protected static ?string $navigationLabel = 'Batch Job Logs';

    public static function form(Schema $schema): Schema
    {
        return RobotJobLogForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RobotJobLogInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RobotJobLogsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRobotJobLogs::route('/'),
            'create' => CreateRobotJobLog::route('/create'),
            'view' => ViewRobotJobLog::route('/{record}'),
            'edit' => EditRobotJobLog::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
