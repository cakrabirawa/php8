<?php

namespace App\Filament\Resources\GroupUsers;

use App\Filament\Resources\BaseResource;
use App\Filament\Resources\GroupUsers\Pages\CreateGroupUser;
use App\Filament\Resources\GroupUsers\Pages\EditGroupUser;
use App\Filament\Resources\GroupUsers\Pages\ListGroupUsers;
use App\Filament\Resources\GroupUsers\Pages\ViewGroupUser;
use App\Filament\Resources\GroupUsers\Schemas\GroupUserForm;
use App\Filament\Resources\GroupUsers\Schemas\GroupUserInfolist;
use App\Filament\Resources\GroupUsers\Tables\GroupUsersTable;
use App\Models\GroupUser;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GroupUserResource extends Resource
{
    protected static ?string $model = GroupUser::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCheckBadge;

    protected static ?string $recordTitleAttribute = 'Group User';
    protected static ?string $modelLabel = 'Group User';

    protected static string|UnitEnum|null $navigationGroup = 'Admin';

    public static function form(Schema $schema): Schema
    {
        return GroupUserForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return GroupUserInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GroupUsersTable::configure($table);
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
            'index' => ListGroupUsers::route('/'),
            'create' => CreateGroupUser::route('/create'),
            'view' => ViewGroupUser::route('/{record}'),
            'edit' => EditGroupUser::route('/{record}/edit'),
        ];
    }
}
