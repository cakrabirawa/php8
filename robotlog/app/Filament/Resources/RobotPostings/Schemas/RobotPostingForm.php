<?php

namespace App\Filament\Resources\RobotPostings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RobotPostingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('index_baris')
                    ->numeric(),
                TextInput::make('invoice_no')
                    ->required(),
                TextInput::make('company'),
                TextInput::make('invoice_account'),
                TextInput::make('name'),
                TextInput::make('purchase_order'),
            ]);
    }
}
