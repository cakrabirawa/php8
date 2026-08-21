<?php

namespace App\Filament\Resources\RobotPostings\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class RobotPostingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('index_baris')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('invoice_number'),
                TextEntry::make('company')
                    ->placeholder('-'),
                // TextEntry::make('invoice_account')
                //     ->placeholder('-'),
                TextEntry::make('name')
                    ->placeholder('-'),
                TextEntry::make('purchase_order')
                    ->placeholder('-'),
                TextEntry::make('invoice_received_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('last_job_error_details_log')
                    ->label('Error Details Log')
                    ->limit(200)
                    ->wrap()
                    ->tooltip(fn($state) => $state),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
