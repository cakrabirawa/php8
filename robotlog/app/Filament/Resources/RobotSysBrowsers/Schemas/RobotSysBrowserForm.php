<?php

namespace App\Filament\Resources\RobotSysBrowsers\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RobotSysBrowserForm
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
                TextInput::make('invoice_no')
                    ->required(),
                TextInput::make('server_id')
                    ->required(),
                TextInput::make('status')
                    ->required(),
                DateTimePicker::make('start_date')
                    ->required(),
                DateTimePicker::make('end_date')
                    ->required(),
            ]);
    }
}
