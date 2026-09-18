<?php

namespace App\Filament\Resources\InvoiceLogs\Tables;

use App\Filament\Resources\InvoiceLogs\InvoiceLogResource;
use App\Models\InvoiceLog;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InvoiceLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('RequestStatus')
                //     ->searchable(),
                TextColumn::make('VendInvoiceInfoTable_Num')->label("Invoice Number")
                    ->sortable()
                    ->searchable(),
                TextColumn::make('VendInvoiceInfoTable_dataAreaId')->label("Data Area")
                    ->sortable()
                    ->searchable(),
                TextColumn::make('VendInvoiceInfoTable_InvoiceAccount')->label("Vendor Invoice")
                    ->sortable()
                    ->searchable(),
                TextColumn::make('VendInvoiceInfoTable_PurchName')->label("Vendor Name")
                    ->sortable()
                    ->searchable(),
                TextColumn::make('VendInvoiceInfoTable_PurchId')->label("Purchase No")
                    ->sortable()
                    ->searchable(),
                // TextColumn::make('VendInvoiceInfoTable_ReceivedDate')
                //     ->date()
                //     ->sortable(),
                // TextColumn::make('VendInvoiceInfoTable_DocumentDate')
                //     ->date()
                //     ->sortable(),
                // TextColumn::make('VendInvoiceInfoTable_ImportedAmount')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('LastMatchVariance')
                //     ->searchable(),
                // TextColumn::make('MatchApproved')
                //     ->searchable(),
                TextColumn::make('packingSlipId')->label("Packing Slip")
                    ->sortable()
                    ->searchable(),
                TextColumn::make('VendInvoiceInfoTable_KREInvoiceApprovalStatus')->label("Approval Status")
                    ->sortable()
                    ->searchable(),
                // TextColumn::make('VendInvoiceInfoTable_KRECSA')
                //     ->searchable(),
                TextColumn::make('VendInvoiceInfoTable_KREPurchPoolId')->label("Purchase Pool")
                    ->sortable()
                    ->searchable(),
                // TextColumn::make('VendInvoiceInfoTable_KREIntercoSalesInv')
                //     ->searchable(),
                // TextColumn::make('VendInvoiceInfoTable_KRETaxIDNTaxNum')
                //     ->searchable(),
                // TextColumn::make('VendInvoiceInfoTable_KREIsTotalUpdated')
                //     ->searchable(),
                // TextColumn::make('VendInvoiceInfoTable_KREIsSplitInvoice')
                //     ->searchable(),
                // TextColumn::make('VendInvoiceInfoTable_KREIsSplitInvoiceReturn')
                //     ->searchable(),
                // TextColumn::make('VendInvoiceInfoTable_createdDateTime')
                //     ->dateTime()
                //     ->sortable(),
                TextColumn::make('VendInvoiceInfoTable_RKGReadytoPostCreatedDateTime')->label("Ready to Post Date")
                    ->dateTime()
                    ->sortable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->sortable()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->sortable()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                // EditAction::make(),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ])
            ->recordUrl(
                fn(InvoiceLog $record): string => InvoiceLogResource::getUrl('view', ['record' => $record]),
            )
        ;
    }
}
