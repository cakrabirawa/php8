<?php

namespace App\Filament\Resources\RobotSysBrowsers\Tables;

use App\Models\RobotSysBrowser;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
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
                    ->color(fn (string $state): string => match ($state) {
                        'ERROR' => 'danger',
                        'SUCCESS' => 'success',
                        'END' => 'success',
                        'ENDED' => 'success',
                        'EXECUTING' => 'warning',
                        default => 'gray',
                    })->action(
                        Action::make('viewLatestLog')
                            ->label(fn ($record) => "Detail Log Robot - Invoice Number: {$record->invoice_number}")
                            ->mountUsing(fn ($form, $record) => $form->fill($record->latestRobotLog?->toArray() ?? []))
                            ->disabledSchema()
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
                                    ]),
                            ])
                            ->modalSubmitAction(false)
                            ->modalCancelActionLabel('Close')
                    )
                    ->searchable(),
                TextColumn::make('invoice_no')->label('Invoice No')
                    // ->color(fn(string $state, $record): string => match ($record->status) {
                    //     'ERROR' => 'danger',
                    //     'SUCCESS' => 'success',
                    //     'END' => 'success',
                    //     'ENDED' => 'success',
                    //     'EXECUTING' => 'warning',
                    //     default => 'gray',
                    // })
                    // ->badge()
                    ->sortable()
                    ->copyable()
                    ->copyMessage(fn (string $state): string => "Teks '{$state}' berhasil disalin!")
                    ->copyMessageDuration(1500)
                    ->searchable(),
                TextColumn::make('batch_job_id')->label('Batch Job Id')
                    ->sortable()
                    ->copyable()
                    ->copyMessage(fn (string $state): string => "Teks '{$state}' berhasil disalin!")
                    ->copyMessageDuration(1500)
                    ->searchable(),
                TextColumn::make('company')->label('Company')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('timestamp')->label('Time Stamp')
                    ->sortable()
                    ->dateTime('d/m/y H:i:s')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('caption')->label('Caption')
                    ->sortable()
                    ->searchable()
                    ->searchable(),
                TextColumn::make('start_date')->label('Start Date')
                    ->searchable()
                    ->dateTime('d/m/y H:i:s')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('end_date')->label('End Date')
                    ->searchable()
                    ->dateTime('d/m/y H:i:s')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('duration')
                    ->label('Duration')
                    ->getStateUsing(function ($record) {
                        if (! $record->start_date || ! $record->end_date) {
                            return '-';
                        }
                        $start = Carbon::parse($record->start_date);
                        $end = Carbon::parse($record->end_date);

                        return $start->diffForHumans($end, [
                            'syntax' => CarbonInterface::DIFF_ABSOLUTE,
                            'short' => true,
                            'parts' => 2,
                        ]);
                    })
                    ->searchable(),
                TextColumn::make('send_notif_status')->label('Send Notif Status')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('send_notif_status_timestamp')->label('Send Notif Status Time Stamp')
                    ->searchable()
                    ->sortable()
                    ->dateTime('d/m/y H:i:s'),
                TextColumn::make('created_at')
                    ->dateTime('d/m/y H:i:s')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime('d/m/y H:i:s')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'ERROR' => 'ERROR',
                        'SUCCESS' => 'SUCCESS',
                        'END' => 'END',
                        'ENDED' => 'ENDED',
                        'EXECUTING' => 'EXECUTING',
                    ])
                    ->default('EXECUTING'),
                SelectFilter::make('company')
                    ->options(
                        RobotSysBrowser::query()
                            ->whereNotNull('company', 'and')
                            ->distinct()
                            ->pluck('company', 'company')
                            ->toArray()
                    ),

            ])
            ->defaultSort('start_date', 'desc')
            ->striped()
            ->groups([
                Group::make('status')
                    ->label('Status')
                    ->collapsible(),
                Group::make('invoice_no')
                    ->label('Invoice No')
                    ->collapsible(),
                Group::make('company')
                    ->label('Company')
                    ->collapsible(),
            ])
            ->defaultGroup('status');
    }
}
