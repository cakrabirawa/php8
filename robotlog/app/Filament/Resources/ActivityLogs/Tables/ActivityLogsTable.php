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
                TextColumn::make('entity', 'Entity')->sortable()->searchable(),
                TextColumn::make('count', 'Count')->sortable()->searchable(),
                TextColumn::make('start_date', 'Start Date')->sortable()->searchable(),
                TextColumn::make('end_date', 'End Date')->sortable()->searchable(),
                TextColumn::make('duration', 'Duration')->sortable()->searchable(),
                TextColumn::make('timestamp', 'Timestamp')->sortable()->searchable(),

            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                // EditAction::make(),
            ])
            //->striped()
            ->defaultSort(function (Builder $query): Builder {
                return $query
                    ->orderBy('count', 'desc')
                    ->orderBy('end_date', 'desc');
            })
            // ->toolbarActions([
            //     BulkActionGroup::make([
            //         DeleteBulkAction::make(),
            //     ]),
            // ])
        ;
    }
}
