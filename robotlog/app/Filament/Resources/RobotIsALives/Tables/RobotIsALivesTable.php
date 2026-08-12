<?php

namespace App\Filament\Resources\RobotIsALives\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RobotIsALivesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->addSelect([
                '*',
                'diff_seconds' => DB::table('robot_is_alive')
                    ->selectRaw("CAST((strftime('%s', 'now') - strftime('%s', robot_last_activity_at)) AS INTEGER)")
                    ->whereColumn('id', 'robot_is_alive.id')
            ]))
            ->columns([
                TextColumn::make('robot_name')
                    ->searchable(),
                TextColumn::make('robot_last_activity_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('diff_seconds')
                    ->label('Robot Diff Time Current')
                    ->sortable()
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        // Fitur pencarian kustom jika user mengetik angka detik/menit tertentu
                        return $query->whereRaw("CAST((strftime('%s', 'now') - strftime('%s', robot_last_activity_at)) AS INTEGER) LIKE ?", ["%{$search}%"]);
                    })
                    ->getStateUsing(function ($record) {
                        if (is_null($record->diff_seconds)) {
                            return '-';
                        }

                        // Mengubah hitungan detik mentah database menjadi format manusiawi (Carbon)
                        return Carbon::now()->subSeconds($record->diff_seconds)->diffForHumans([
                            'syntax' => Carbon::DIFF_RELATIVE_TO_NOW,
                            'short' => true, // Menghasilkan format ringkas seperti "3m ago", "1h ago"
                        ]);
                    }),
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
            // ->toolbarActions([
            //     BulkActionGroup::make([
            //         DeleteBulkAction::make(),
            //     ]),
            // ])
            ->defaultSort('robot_last_activity_at', 'desc')
        ;
    }
}
