<?php

namespace App\Filament\Resources\RobotSysBrowsers\Tables;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
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
                TextColumn::make('invoice_no')->label("Invoice Number")
                    ->sortable()
                    ->copyable()
                    ->copyMessage(fn(string $state): string => "Teks '{$state}' berhasil disalin!")
                    ->copyMessageDuration(1500)
                    ->searchable(),
                TextColumn::make('batch_job_id')->label("Batch Job Id")
                    ->sortable()
                    ->copyable()
                    ->copyMessage(fn(string $state): string => "Teks '{$state}' berhasil disalin!")
                    ->copyMessageDuration(1500)
                    ->searchable(),
                TextColumn::make('company')->label("Company")
                    ->sortable()
                    ->searchable(),
                TextColumn::make('timestamp')->label("Time Stamp")
                    ->sortable()
                    ->dateTime('d/m/y H:i:s')
                    ->sortable(),
                TextColumn::make('caption')->label("Caption")
                    ->sortable()
                    ->searchable(),
                TextColumn::make('server_id')->label("Server Id")
                    ->sortable()
                    ->searchable(),
                TextColumn::make('start_date')->label("Start Date")
                    ->searchable()
                    ->dateTime('d/m/y H:i:s')
                    ->sortable(),
                TextColumn::make('end_date')->label("End Date")
                    ->searchable()
                    ->dateTime('d/m/y H:i:s')
                    ->sortable(),
                TextColumn::make('duration')
                    ->label('Duration')
                    ->getStateUsing(function ($record) {
                        // Validasi jika salah satu tanggal kosong agar tidak error
                        if (!$record->start_date || !$record->end_date) {
                            return '-';
                        }

                        $start = Carbon::parse($record->start_date);
                        $end = Carbon::parse($record->end_date);

                        // Menghitung selisih absolut (tanpa kata "ago" atau "from now")
                        return $start->diffForHumans($end, [
                            'syntax' => CarbonInterface::DIFF_ABSOLUTE,
                            'short' => true, // Menghasilkan teks ringkas seperti "5s", "2m", "1h"
                            'parts' => 2,    // Contoh jika detail: "1m 15s"
                        ]);
                    }),
                TextColumn::make('created_at')
                    ->dateTime('d/m/y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime('d/m/y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            // ->headerActions([
            //     Action::make('refresh')
            //         ->label('Refresh')
            //         ->icon('heroicon-m-arrow-path')
            //         ->color('danger')
            //         ->action(function ($livewire) {
            //             $livewire->resetTable();
            //         }),
            // ])
            // ->filters([
            //     // 1. Contoh Filter Select dengan Nilai Default
            //     SelectFilter::make('status')
            //         ->options([
            //             'ERROR' => 'ERROR',
            //             'SUCCESS' => 'SUCCESS',
            //             'END' => 'END',
            //             'ENDED' => 'ENDED',
            //             'EXECUTING' => 'EXECUTING',
            //         ])
            //         ->default('ERROR'), // Kolom otomatis terfilter 'draft' saat halaman dibuka

            // ])
            ->recordActions([
                // ViewAction::make(),
                // EditAction::make(),
            ])
            ->defaultSort('start_date', 'desc')
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ])
            ->striped()
        ;
    }
}
