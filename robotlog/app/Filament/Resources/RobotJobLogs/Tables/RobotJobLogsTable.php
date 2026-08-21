<?php

namespace App\Filament\Resources\RobotJobLogs\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RobotJobLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('job_id')
                    ->label('Job ID')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('dialog_title')
                    ->label('Dialog Title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('error_details_log')
                    ->label('Error Details Log')
                    ->searchable()
                    ->sortable()
                    ->limit(100)
                    ->wrap()
                    ->tooltip(fn($state) => $state),
                TextColumn::make('duration')
                    ->label('Duration')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('start_date')
                    ->label('Start Date')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable(),
                TextColumn::make('end_date')
                    ->label('End Date')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable(),
                TextColumn::make('timestamp_extracted')
                    ->label('Timestamp Extracted')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('timestamp_extracted', 'desc')
            ->striped();
    }
}
