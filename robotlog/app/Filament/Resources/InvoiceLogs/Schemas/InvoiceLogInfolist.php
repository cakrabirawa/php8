<?php

namespace App\Filament\Resources\InvoiceLogs\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class InvoiceLogInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('RequestStatus')
                    ->placeholder('-'),
                TextEntry::make('VendInvoiceInfoTable_Num'),
                TextEntry::make('VendInvoiceInfoTable_dataAreaId'),
                TextEntry::make('VendInvoiceInfoTable_InvoiceAccount'),
                TextEntry::make('VendInvoiceInfoTable_PurchName'),
                TextEntry::make('VendInvoiceInfoTable_PurchId'),
                TextEntry::make('VendInvoiceInfoTable_ReceivedDate')
                    ->date(),
                TextEntry::make('VendInvoiceInfoTable_DocumentDate')
                    ->date(),
                TextEntry::make('VendInvoiceInfoTable_ImportedAmount')
                    ->numeric(),
                TextEntry::make('LastMatchVariance')
                    ->placeholder('-'),
                TextEntry::make('MatchApproved')
                    ->placeholder('-'),
                TextEntry::make('packingSlipId')
                    ->placeholder('-'),
                TextEntry::make('VendInvoiceInfoTable_KREInvoiceApprovalStatus')
                    ->placeholder('-'),
                TextEntry::make('VendInvoiceInfoTable_KRECSA')
                    ->placeholder('-'),
                TextEntry::make('VendInvoiceInfoTable_KREPurchPoolId')
                    ->placeholder('-'),
                TextEntry::make('VendInvoiceInfoTable_KREIntercoSalesInv')
                    ->placeholder('-'),
                TextEntry::make('VendInvoiceInfoTable_KRETaxIDNTaxNum')
                    ->placeholder('-'),
                TextEntry::make('VendInvoiceInfoTable_KREIsTotalUpdated')
                    ->placeholder('-'),
                TextEntry::make('VendInvoiceInfoTable_KREIsSplitInvoice')
                    ->placeholder('-'),
                TextEntry::make('VendInvoiceInfoTable_KREIsSplitInvoiceReturn')
                    ->placeholder('-'),
                TextEntry::make('VendInvoiceInfoTable_createdDateTime')
                    ->dateTime(),
                TextEntry::make('VendInvoiceInfoTable_RKGReadytoPostCreatedDateTime')
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
