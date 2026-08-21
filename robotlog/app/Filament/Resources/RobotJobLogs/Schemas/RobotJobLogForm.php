<?php

namespace App\Filament\Resources\RobotJobLogs\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RobotJobLogForm
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        DateTimePicker::make('start_date')
          ->label('Start Date')
          ->required(),
        DateTimePicker::make('end_date')
          ->label('End Date')
          ->required(),
        TextInput::make('duration')
          ->label('Duration')
          ->required(),
        TextInput::make('job_id')
          ->label('Job ID')
          ->required(),
        DateTimePicker::make('timestamp_extracted')
          ->label('Timestamp Extracted')
          ->required(),
        TextInput::make('dialog_title')
          ->label('Dialog Title')
          ->required(),
        Textarea::make('error_details_log')
          ->label('Error Details Log')
          ->rows(8)
          ->required(),
      ]);
  }
}
