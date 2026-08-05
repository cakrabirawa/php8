<?php

namespace App\Filament\Resources\RobotIsALives\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class RobotIsALiveInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('robot_name'),
                TextEntry::make('robot_last_activity_at')
                    ->dateTime(),
                TextEntry::make('robot_diff_time_current')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
