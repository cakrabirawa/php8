<?php

namespace App\Filament\Resources\RobotSysBrowsers\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RobotSysBrowsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('status')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'ERROR' => 'danger',
                        'SUCCESS' => 'success',
                        'END' => 'success',
                        'ENDED' => 'success',
                        'EXECUTING' => 'warning',
                        default => 'gray',
                    })->action(
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
                TextColumn::make('invoice_no')
                    ->searchable(),
                TextColumn::make('batch_job_id')
                    ->searchable(),
                TextColumn::make('company')
                    ->searchable(),
                TextColumn::make('timestamp')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('automatic_transaction')
                    ->searchable(),
                TextColumn::make('caption')
                    ->searchable(),
                TextColumn::make('server_id')
                    ->searchable(),
                TextColumn::make('start_date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('end_date')
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
            ->recordActions([
                ViewAction::make(),
                // EditAction::make(),
            ])
            ->defaultSort('timestamp', 'desc')
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
