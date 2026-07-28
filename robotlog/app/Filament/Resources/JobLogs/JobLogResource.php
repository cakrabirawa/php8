<?php

namespace App\Filament\Resources\JobLogs;

use App\Filament\Resources\JobLogs\Pages\CreateJobLog;
use App\Filament\Resources\JobLogs\Pages\EditJobLog;
use App\Filament\Resources\JobLogs\Pages\ListJobLogs;
use App\Filament\Resources\JobLogs\Pages\ViewJobLog;
use App\Filament\Resources\JobLogs\Schemas\JobLogForm;
use App\Filament\Resources\JobLogs\Schemas\JobLogInfolist;
use App\Filament\Resources\JobLogs\Tables\JobLogsTable;
use App\Models\JobLog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class JobLogResource extends Resource
{
    protected static ?string $model = JobLog::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Batch Job History';

    protected static string|UnitEnum|null $navigationGroup = 'Logs';

    protected static ?string $navigationLabel = 'Robot Job History';

    public static function form(Schema $schema): Schema
    {
        return JobLogForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return JobLogInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JobLogsTable::configure($table);
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
            'index' => ListJobLogs::route('/'),
            // 'create' => CreateJobLog::route('/create'),
            'view' => ViewJobLog::route('/{record}'),
            // 'edit' => EditJobLog::route('/{record}/edit'),
        ];
    }
}
