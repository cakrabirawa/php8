<?php

namespace App\Filament\Resources\RobotPostings;

use App\Filament\Resources\RobotPostings\Pages\CreateRobotPosting;
use App\Filament\Resources\RobotPostings\Pages\EditRobotPosting;
use App\Filament\Resources\RobotPostings\Pages\ListRobotPostings;
use App\Filament\Resources\RobotPostings\Pages\ViewRobotPosting;
use App\Filament\Resources\RobotPostings\Schemas\RobotPostingForm;
use App\Filament\Resources\RobotPostings\Schemas\RobotPostingInfolist;
use App\Filament\Resources\RobotPostings\Tables\RobotPostingsTable;
use App\Models\RobotPosting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class RobotPostingResource extends Resource
{
    protected static ?string $model = RobotPosting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Robot Posting';

    protected static string|UnitEnum|null $navigationGroup = 'Robot Logs';

    protected static ?string $navigationLabel = 'Robot Posting';

    public static function form(Schema $schema): Schema
    {
        return RobotPostingForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RobotPostingInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RobotPostingsTable::configure($table);
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
            'index' => ListRobotPostings::route('/'),
            'create' => CreateRobotPosting::route('/create'),
            'view' => ViewRobotPosting::route('/{record}'),
            'edit' => EditRobotPosting::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
