<?php

namespace App\Filament\Resources\InvoiceLogs\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InvoiceLogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('RequestStatus'),
                TextInput::make('VendInvoiceInfoTable_Num')
                    ->required(),
                TextInput::make('VendInvoiceInfoTable_dataAreaId')
                    ->required(),
                TextInput::make('VendInvoiceInfoTable_InvoiceAccount')
                    ->required(),
                TextInput::make('VendInvoiceInfoTable_PurchName')
                    ->required(),
                TextInput::make('VendInvoiceInfoTable_PurchId')
                    ->required(),
                DatePicker::make('VendInvoiceInfoTable_ReceivedDate')
                    ->required(),
                DatePicker::make('VendInvoiceInfoTable_DocumentDate')
                    ->required(),
                TextInput::make('VendInvoiceInfoTable_ImportedAmount')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('LastMatchVariance'),
                TextInput::make('MatchApproved'),
                TextInput::make('packingSlipId'),
                TextInput::make('VendInvoiceInfoTable_KREInvoiceApprovalStatus'),
                TextInput::make('VendInvoiceInfoTable_KRECSA'),
                TextInput::make('VendInvoiceInfoTable_KREPurchPoolId'),
                TextInput::make('VendInvoiceInfoTable_KREIntercoSalesInv'),
                TextInput::make('VendInvoiceInfoTable_KRETaxIDNTaxNum'),
                TextInput::make('VendInvoiceInfoTable_KREIsTotalUpdated'),
                TextInput::make('VendInvoiceInfoTable_KREIsSplitInvoice'),
                TextInput::make('VendInvoiceInfoTable_KREIsSplitInvoiceReturn'),
                DateTimePicker::make('VendInvoiceInfoTable_createdDateTime')
                    ->required(),
                DateTimePicker::make('VendInvoiceInfoTable_RKGReadytoPostCreatedDateTime')
                    ->required(),
            ]);
    }
}
