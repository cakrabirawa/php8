<?php

namespace App\Filament\Resources\RobotLogs\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class RobotLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('status')
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
                        Action::make('check_monitoring')
                            ->modalHeading(fn(Model $record): string => "Detail Monitoring Status #{$record->batch_job_id}")
                            ->modalSubmitActionLabel('OK')
                            ->modalCancelAction(false)
                            ->modalWidth('lg')
                            ->modalContent(function ($record) {
                                return view('filament.components.monitoring-lazy', [
                                    'record' => $record,
                                ]);
                            })
                    ),
                TextColumn::make('invoice_no')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('timestamp')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('automatic_transaction')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('batch_job_id')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('caption')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('company')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('server_id')
                    ->sortable()
                    ->searchable(),
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
                SelectFilter::make('status')
                    ->label('Saring Berdasarkan Status')
                    ->options([
                        'ERROR' => 'Error Only',
                        'SUCCESS' => 'Success Only',
                    ])
                    ->placeholder('Semua Status'),

            ])
            ->recordUrl(null)
            ->recordAction(null)
        ;
    }
}
