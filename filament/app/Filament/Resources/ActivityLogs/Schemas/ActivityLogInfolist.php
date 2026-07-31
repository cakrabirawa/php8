<?php

namespace App\Filament\Resources\ActivityLogs\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ActivityLogInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('entity'),
                TextEntry::make('count'),
                TextEntry::make('start_date'),
                TextEntry::make('end_date'),
                TextEntry::make('duration'),
                TextEntry::make('timestamp'),
            ]);
    }
}
