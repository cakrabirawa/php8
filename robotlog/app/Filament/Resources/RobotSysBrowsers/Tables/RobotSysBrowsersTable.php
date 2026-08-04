<?php

namespace App\Filament\Resources\RobotSysBrowsers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RobotSysBrowsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('timestamp')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('automatic_transaction')
                    ->searchable(),
                TextColumn::make('batch_job_id')
                    ->searchable(),
                TextColumn::make('caption')
                    ->searchable(),
                TextColumn::make('company')
                    ->searchable(),
                TextColumn::make('invoice_no')
                    ->searchable(),
                TextColumn::make('server_id')
                    ->searchable(),
                TextColumn::make('status')
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
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
