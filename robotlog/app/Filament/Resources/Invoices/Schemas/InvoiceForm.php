<?php

namespace App\Filament\Resources\Invoices\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InvoiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('index_baris')
                    ->required()
                    ->numeric(),
                TextInput::make('invoice_number')
                    ->required(),
                TextInput::make('company')
                    ->required(),
                TextInput::make('invoice_account')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('purchase_order')
                    ->required(),
                DatePicker::make('invoice_received_date')
                    ->required(),
                TextInput::make('imported_invoice_amount')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('last_match_status')
                    ->required(),
                TextInput::make('variance_approved'),
                TextInput::make('product_receipt')
                    ->required(),
                TextInput::make('c_status')
                    ->required(),
                TextInput::make('c_ca_csa_number'),
                TextInput::make('c_pool')
                    ->required(),
                TextInput::make('c_intercompany_sales_invoice'),
                TextInput::make('c_tax_invoice_number')
                    ->required(),
                TextInput::make('c_is_total_updated'),
                TextInput::make('c_is_split_invoice'),
                TextInput::make('c_is_split_invoice_return'),
                DateTimePicker::make('created_date_and_time')
                    ->required(),
                DateTimePicker::make('c_ready_to_post_created_datetime')
                    ->required(),
            ]);
    }
}
