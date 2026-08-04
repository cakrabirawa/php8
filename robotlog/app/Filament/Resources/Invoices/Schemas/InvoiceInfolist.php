<?php

namespace App\Filament\Resources\Invoices\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class InvoiceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('invoice_number')->label('Invoice Number'),
                TextEntry::make('company')->label("Company"),
                TextEntry::make('invoice_account')->label("Invoice Account"),
                TextEntry::make('name')->label("Name"),
                TextEntry::make('purchase_order')->label("Purchase Order"),
                TextEntry::make('invoice_received_date')->label("Invoice Received Date")
                    ->dateTime()

                    ->date(),
                TextEntry::make('c_status')->label("Status"),
                TextEntry::make('c_ready_to_post_created_datetime')->label("Ready to Post Created Date and Time")
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),

            ]);
    }
}
