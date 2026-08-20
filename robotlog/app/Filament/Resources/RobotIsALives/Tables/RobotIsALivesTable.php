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
use Carbon\CarbonInterface;

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
                TextColumn::make('robot_name')->label("Robot Name")
                    ->searchable(),
                TextColumn::make('robot_last_activity_at')->label("Robot Last Activity")
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable(),
                TextColumn::make('diff_seconds')
                    ->label('Robot Diff Time')
                    ->sortable()
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->whereRaw("CAST((strftime('%s', 'now') - strftime('%s', robot_last_activity_at)) AS INTEGER) LIKE ?", ["%{$search}%"]);
                    })
                    ->getStateUsing(function ($record) {
                        if (is_null($record->robot_last_activity_at)) {
                            return '-';
                        }
                        $lastActivity = Carbon::parse($record->robot_last_activity_at);
                        return $lastActivity->diffForHumans([
                            'syntax' => CarbonInterface::DIFF_RELATIVE_TO_NOW,
                            'short' => true,
                            'parts' => 2, // Menampilkan detail lebih presisi (misal: 1m 30s)
                        ]);
                    }),
                TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordActions([
                // ViewAction::make(),
            ])
            ->defaultSort('robot_last_activity_at', 'desc')
            ->striped()
        ;
    }
}
