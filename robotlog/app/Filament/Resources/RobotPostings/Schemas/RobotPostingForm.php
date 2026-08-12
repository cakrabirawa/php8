<?php

namespace App\Filament\Resources\RobotPostings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RobotPostingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('index_baris')
                    ->numeric(),
                TextInput::make('invoice_number')
                    ->required(),
                TextInput::make('company'),
                TextInput::make('invoice_account'),
                TextInput::make('name'),
                TextInput::make('purchase_order'),
                DatePicker::make('invoice_received_date'),
                DateTimePicker::make('created_date_and_time'),
                DateTimePicker::make('c_ready_to_post_created_datetime'),
                TextInput::make('imported_invoice_amount')
                    ->numeric(),
                TextInput::make('last_match_status'),
                TextInput::make('variance_approved'),
                TextInput::make('product_receipt'),
                TextInput::make('c_status'),
                TextInput::make('c_ca_csa_number'),
                TextInput::make('c_pool'),
                TextInput::make('c_intercompany_sales_invoice'),
                TextInput::make('c_tax_invoice_number'),
                TextInput::make('c_is_total_updated'),
                TextInput::make('c_is_split_invoice'),
                TextInput::make('c_is_split_invoice_return'),
            ]);
    }
}
