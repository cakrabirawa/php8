<?php

namespace App\Filament\Resources\RobotJobCounts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RobotJobCountsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('count')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('entity')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('start_date')
                    ->searchable()
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->searchable()
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('duration')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('timestamp')
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
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
