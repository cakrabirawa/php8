<?php

namespace App\Filament\Resources\RobotJobCounts\Tables;

use App\Models\RobotSysBrowser;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class RobotJobCountsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->withCount([
                'sysBrowsers as error_count' => fn($q) => $q->whereRaw('UPPER(status) = ?', ['ERROR'])
                    ->whereRaw('trim(UPPER(robot_sys_browser.company)) = trim(UPPER(robot_job_counts.entity))'),

                'sysBrowsers as ended_count' => fn($q) => $q->whereRaw('UPPER(status) = ?', ['ENDED'])
                    ->whereRaw('trim(UPPER(robot_sys_browser.company)) = trim(UPPER(robot_job_counts.entity))'),

                'sysBrowsers as end_count' => fn($q) => $q->whereRaw('UPPER(status) = ?', ['END'])
                    ->whereRaw('trim(UPPER(robot_sys_browser.company)) = trim(UPPER(robot_job_counts.entity))'),

                'sysBrowsers as executing_count' => fn($q) => $q->whereRaw('UPPER(status) = ?', ['EXECUTING'])
                    ->whereRaw('trim(UPPER(robot_sys_browser.company)) = trim(UPPER(robot_job_counts.entity))'),
            ]))
            ->columns([
                TextColumn::make('count')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('entity')
                    ->sortable()
                    ->searchable(),
                // 2. Tampilkan hasil hitungan dari attribute withCount (Sekarang bisa di-sortable!)
                TextColumn::make('error_count')
                    ->label('Status Error')
                    ->badge()
                    ->color('danger')
                    ->sortable(), // Sekarang mendukung fitur pengurutan data

                TextColumn::make('ended_count')
                    ->label('Status Ended')
                    ->badge()
                    ->color('success')
                    ->sortable(),

                TextColumn::make('end_count')
                    ->label('Status End')
                    ->badge()
                    ->color('info')
                    ->sortable(),

                TextColumn::make('executing_count')
                    ->label('Status Executing')
                    ->badge()
                    ->color('warning')
                    ->sortable(),
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
    protected static function countStatus($record, string $status): int
    {
        return RobotSysBrowser::where(DB::raw('UPPER(status)'), $status)
            ->where(DB::raw('UPPER(company)'), strtoupper($record->entity))
            ->count();
    }
}
