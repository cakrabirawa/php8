<?php

namespace App\Filament\Resources\GroupUsers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GroupUserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Group User Name')
                    ->required()
                    ->maxLength(100),
            ]);
    }
}
