<?php

namespace App\Filament\Resources\RobotLogs\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RobotLogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DateTimePicker::make('timestamp')
                    ->required(),
                TextInput::make('automatic_transaction')
                    ->required(),
                TextInput::make('batch_job_id')
                    ->required(),
                TextInput::make('caption')
                    ->required(),
                TextInput::make('company')
                    ->required(),
                TextInput::make('server_id')
                    ->required(),
                TextInput::make('status')
                    ->required(),
            ]);
    }
}
