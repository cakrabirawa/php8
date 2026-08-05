<?php

namespace App\Filament\Resources\RobotJobCounts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RobotJobCountForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DateTimePicker::make('start_date'),
                DateTimePicker::make('end_date'),
                TextInput::make('duration'),
                DateTimePicker::make('timestamp')
                    ->required(),
                TextInput::make('count')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('entity')
                    ->required(),
            ]);
    }
}
