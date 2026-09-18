<?php

namespace App\Filament\Resources\JobLogs\Tables;

use App\Filament\Resources\JobLogs\JobLogResource;
use App\Filament\Resources\JobLogs\Pages\ViewJobLog;
use App\Models\JobLog;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class JobLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('job_id')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('start_date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('duration')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('timestamp_extracted')
                    ->dateTime()
                    ->sortable()
                    ->sortable(),
                TextColumn::make('error_details_log')
                    ->sortable()
                    ->searchable()
                    ->limit(30)
                    ->extraAttributes([
                        'style' => 'max-width: 400px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'
                    ]),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
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
            ->defaultSort('timestamp_extracted', 'desc')
            ->recordActions([
                ViewAction::make(),
            ])
            // ->toolbarActions([
            //     BulkActionGroup::make([
            //         DeleteBulkAction::make(),
            //     ]),
            // ])
            ->recordUrl(
                fn(JobLog $record): string => JobLogResource::getUrl('view', ['record' => $record]),
            )
            //->striped()
        ;
    }
}
