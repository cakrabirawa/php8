<?php

namespace App\Filament\Resources\RobotJobLogs\Tables;

use Carbon\CarbonInterface;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;

class RobotJobLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('batch_job_id')
                    ->label('Batch Job Id')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('robotSysBrowser.invoice_no')
                    ->label('Invoice No')
                    ->default('-')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('caption')
                    ->label('Caption')
                    ->searchable()
                    ->sortable()
                    ->limit(100)
                    ->wrap()
                    ->tooltip(fn($state) => $state),
                TextColumn::make('info')
                    ->label('Info')
                    ->searchable()
                    ->sortable()
                    ->limit(100)
                    ->wrap()
                    ->tooltip(fn($state) => $state),
                TextColumn::make('start_date_time')->label("Start Date")
                    ->searchable()
                    ->dateTime('d/m/y H:i:s')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('end_date_time')->label("End Date")
                    ->searchable()
                    ->dateTime('d/m/y H:i:s')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('duration')
                    ->label('Duration')
                    ->getStateUsing(function ($record) {
                        if (!$record->start_date_time || !$record->end_date_time) {
                            return '-';
                        }
                        $start = Carbon::parse($record->start_date_time);
                        $end = Carbon::parse($record->end_date_time);
                        return $start->diffForHumans($end, [
                            'syntax' => CarbonInterface::DIFF_ABSOLUTE,
                            'short' => true,
                            'parts' => 2,
                        ]);
                    })
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d/m/y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('timestamp_extracted', 'desc')
            ->striped()
            ->groups([
                Group::make('robotSysBrowser.invoice_no')
                    ->label('Invoice No')
                    ->collapsible(),
                Group::make('batch_job_id')
                    ->label('Batch Job Id')
                    ->collapsible(),
            ])
            ->defaultGroup('robotSysBrowser.invoice_no')
        ;
    }
}
