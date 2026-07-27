<?php

namespace App\Filament\Resources\RobotLogs\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class RobotLogInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('timestamp')
                    ->dateTime(),
                TextEntry::make('automatic_transaction'),
                TextEntry::make('batch_job_id'),
                TextEntry::make('caption'),
                TextEntry::make('company'),
                TextEntry::make('server_id'),
                TextEntry::make('status'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
