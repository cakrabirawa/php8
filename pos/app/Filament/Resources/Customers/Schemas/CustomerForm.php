<?php

namespace App\Filament\Resources\Customers\Schemas;

use App\Models\Customer;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('member_code')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->default(fn() => 'MBR-' . str_pad((Customer::max('id') + 1), 4, '0', STR_PAD_LEFT))
                    ->dehydrated()
                    ->disabled(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('phone')
                    ->tel(),
                Select::make('member_type_id')
                    ->relationship('memberType', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                TextInput::make('points')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
