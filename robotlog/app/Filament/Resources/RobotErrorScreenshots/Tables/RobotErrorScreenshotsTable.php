<?php

namespace App\Filament\Resources\RobotErrorScreenshots\Tables;

use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class RobotErrorScreenshotsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('file_name')
                    ->label('Screenshot Error')
                    ->disk('screenshots')
                    ->visibility('public')
                    ->imageHeight(40)
                    ->imageWidth(40)
                    ->getStateUsing(function ($record) {
                        if (! $record->file_name) {
                            return null;
                        }

                        return Storage::disk('screenshots')->url($record->file_name);
                    }),

                TextColumn::make('nama_robot')
                    ->label('Nama Robot')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped();
    }
}
