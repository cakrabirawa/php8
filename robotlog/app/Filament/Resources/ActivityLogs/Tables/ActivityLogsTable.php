<?php

namespace App\Filament\Resources\ActivityLogs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ActivityLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('entity')->label('Entity')->sortable()->searchable(),
                TextColumn::make('count')->label('Count')->sortable()->searchable(),
                TextColumn::make('start_date')->label('Start Date')->sortable()->searchable(),
                TextColumn::make('end_date')->label('End Date')->sortable()->searchable(),
                TextColumn::make('duration')->label('Duration')->sortable()->searchable(),
                TextColumn::make('timestamp')->label('Time Stamp')->sortable()->searchable(),

            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->defaultSort(function (Builder $query): Builder {
                return $query
                    ->orderBy('count', 'desc')
                    ->orderBy('end_date', 'desc');
            })
        ;
    }
}
