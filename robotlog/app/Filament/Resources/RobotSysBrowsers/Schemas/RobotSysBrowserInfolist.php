<?php

namespace App\Filament\Resources\RobotSysBrowsers\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class RobotSysBrowserInfolist
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
                TextEntry::make('invoice_no'),
                TextEntry::make('server_id'),
                TextEntry::make('status'),
                TextEntry::make('start_date')
                    ->dateTime(),
                TextEntry::make('end_date')
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
