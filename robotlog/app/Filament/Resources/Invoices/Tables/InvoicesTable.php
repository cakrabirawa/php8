<?php

namespace App\Filament\Resources\Invoices\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InvoicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('robot_logs_count')
                    ->counts('robotLogs')
                    ->label('Attemtps')
                    ->sortable(),
                TextColumn::make('latestRobotLog.status')->label('Last Status')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'ERROR' => 'danger',
                        'SUCCESS' => 'success',
                        'END' => 'success',
                        'WARNING' => 'warning',
                        default => 'gray',
                    })
                    ->action(
                        Action::make('viewLatestLog')
                            ->label(fn($record) => "Detail Log Robot - Invoice Number: {$record->invoice_number}")
                            // Mengatur agar isi modal diambil dari data RobotLog terkait
                            ->mountUsing(fn($form, $record) => $form->fill($record->latestRobotLog?->toArray() ?? []))
                            // Mengubah popup menjadi mode "view saja" (menghilangkan tombol submit/save)
                            ->disabledSchema()
                            // Menentukan isi/layout di dalam popup modal
                            ->schema([
                                Grid::make()
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('timestamp')
                                            ->label('Waktu Log'),
                                        TextInput::make('status')
                                            ->label('Status'),
                                        TextInput::make('caption')
                                            ->label('Keterangan / Caption'),
                                        TextInput::make('batch_job_id')
                                            ->label('Batch Job Id'),
                                        TextInput::make('server_id')
                                            ->label('Server Id'),
                                        TextInput::make('automatic_transaction')
                                            ->label('Transaksi Otomatis'),
                                    ])
                            ])
                            // Menghilangkan tombol "Cancel" bawaan dan hanya menyisakan tombol tutup
                            ->modalSubmitAction(false)
                            ->modalCancelActionLabel('Close')
                    ),
                TextColumn::make('invoice_number')->label('Invoice Number')
                    ->searchable(),
                TextColumn::make('company')->label("Company")
                    ->searchable(),
                TextColumn::make('invoice_account')->label("Invoice Account")
                    ->searchable(),
                TextColumn::make('name')->label("Name")
                    ->searchable(),
                TextColumn::make('purchase_order')->label("Purchase Order")
                    ->searchable(),
                TextColumn::make('invoice_received_date')->label("Invoice Received Date")
                    ->dateTime()
                    ->searchable()
                    ->date()
                    ->sortable(),
                TextColumn::make('c_status')->label("Status")
                    ->searchable(),
                TextColumn::make('c_ready_to_post_created_datetime')->label("Ready to Post Created Date and Time")
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            // ->recordActions([
            //     ViewAction::make(),
            //     EditAction::make(),
            // ])
            // ->toolbarActions([
            //     BulkActionGroup::make([
            //         DeleteBulkAction::make(),
            //     ]),
            // ])
        ;
    }
}
