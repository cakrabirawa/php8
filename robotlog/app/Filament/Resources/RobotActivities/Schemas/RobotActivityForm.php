<?php

namespace App\Filament\Resources\RobotActivities\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RobotActivityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('robot_name')
                    ->required(),
                DateTimePicker::make('robot_last_activity_at')
                    ->required(),
                TextInput::make('robot_diff_time_current')
                    ->required(),
            ]);
    }
}
