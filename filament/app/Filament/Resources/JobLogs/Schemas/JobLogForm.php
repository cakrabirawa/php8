<?php

namespace App\Filament\Resources\JobLogs\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class JobLogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DateTimePicker::make('start_date')
                    ->required(),
                DateTimePicker::make('end_date')
                    ->required(),
                TextInput::make('duration')
                    ->required(),
                TextInput::make('job_id')
                    ->required(),
                DateTimePicker::make('timestamp_extracted')
                    ->required(),
                TextInput::make('dialog_title')
                    ->required(),
                Textarea::make('error_details_log')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
