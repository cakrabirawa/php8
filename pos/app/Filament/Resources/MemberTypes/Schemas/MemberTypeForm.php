<?php

namespace App\Filament\Resources\MemberTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MemberTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('discount_percentage')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
