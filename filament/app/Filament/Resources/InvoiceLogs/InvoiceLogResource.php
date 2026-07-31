<?php

namespace App\Filament\Resources\InvoiceLogs;

use App\Filament\Resources\InvoiceLogs\Pages\CreateInvoiceLog;
use App\Filament\Resources\InvoiceLogs\Pages\EditInvoiceLog;
use App\Filament\Resources\InvoiceLogs\Pages\ListInvoiceLogs;
use App\Filament\Resources\InvoiceLogs\Pages\ViewInvoiceLog;
use App\Filament\Resources\InvoiceLogs\Schemas\InvoiceLogForm;
use App\Filament\Resources\InvoiceLogs\Schemas\InvoiceLogInfolist;
use App\Filament\Resources\InvoiceLogs\Tables\InvoiceLogsTable;
use App\Models\InvoiceLog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class InvoiceLogResource extends Resource
{
    protected static ?string $model = InvoiceLog::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBox;

    protected static ?string $recordTitleAttribute = 'Invoice Status';

    protected static string|UnitEnum|null $navigationGroup = 'Robot Logs';

    protected static ?string $navigationLabel = 'Invoice Status';

    public static function form(Schema $schema): Schema
    {
        return InvoiceLogForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return InvoiceLogInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InvoiceLogsTable::configure($table);
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
            'index' => ListInvoiceLogs::route('/'),
            // 'create' => CreateInvoiceLog::route('/create'),
            'view' => ViewInvoiceLog::route('/{record}'),
            // 'edit' => EditInvoiceLog::route('/{record}/edit'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
