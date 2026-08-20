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
            ->modifyQueryUsing(fn(Builder $query) => $query->addSelect([
                // Hitung error_count secara mandiri bypass relasi kaku
                'count_job' => DB::table('robot_sys_browser')
                    ->selectRaw('count(*)')
                    ->whereRaw('trim(UPPER(company)) = trim(UPPER(robot_job_counts.entity))'),

                // Hitung error_count secara mandiri bypass relasi kaku
                'error_count' => DB::table('robot_sys_browser')
                    ->selectRaw('count(*)')
                    ->whereRaw('trim(UPPER(status)) = ?', ['ERROR'])
                    ->whereRaw('trim(UPPER(company)) = trim(UPPER(robot_job_counts.entity))'),

                // Hitung ended_count
                'ended_count' => DB::table('robot_sys_browser')
                    ->selectRaw('count(*)')
                    ->whereRaw('trim(UPPER(status)) = ?', ['ENDED'])
                    ->whereRaw('trim(UPPER(company)) = trim(UPPER(robot_job_counts.entity))'),

                // Hitung end_count
                'end_count' => DB::table('robot_sys_browser')
                    ->selectRaw('count(*)')
                    ->whereRaw('trim(UPPER(status)) = ?', ['END'])
                    ->whereRaw('trim(UPPER(company)) = trim(UPPER(robot_job_counts.entity))'),

                // Hitung executing_count
                'executing_count' => DB::table('robot_sys_browser')
                    ->selectRaw('count(*)')
                    ->whereRaw('trim(UPPER(status)) = ?', ['EXECUTING'])
                    ->whereRaw('trim(UPPER(company)) = trim(UPPER(robot_job_counts.entity))'),

                // Hitung executing_count
                'other_count' => DB::table('robot_sys_browser')
                    ->selectRaw('count(*)')
                    ->whereRaw('trim(UPPER(status)) not in (?, ?, ?, ?)', ['ERROR', 'ENDED', 'END', 'EXECUTING'])
                    ->whereRaw('trim(UPPER(company)) = trim(UPPER(robot_job_counts.entity))'),
            ]))
            ->columns([
                // TextColumn::make('count_job')
                //     ->numeric()
                //     ->sortable(),
                TextColumn::make('entity')
                    ->sortable()
                    ->searchable(),
                // 2. Tampilkan hasil hitungan dari attribute withCount (Sekarang bisa di-sortable!)
                TextColumn::make('error_count')
                    ->label('Error')
                    ->badge()
                    ->color('danger')
                    ->sortable(), // Sekarang mendukung fitur pengurutan data

                TextColumn::make('ended_count')
                    ->label('Ended')
                    ->badge()
                    ->color('success')
                    ->sortable(),
                TextColumn::make('end_count')
                    ->label('End')
                    ->badge()
                    ->color('info')
                    ->sortable(),
                TextColumn::make('executing_count')
                    ->label('Executing')
                    ->badge()
                    ->color('warning')
                    ->sortable(),
                TextColumn::make('other_count')
                    ->label('Others')
                    ->badge()
                    ->color('success')
                    ->sortable(),
                TextColumn::make('start_date')
                    ->searchable()
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable(),
                TextColumn::make('end_date')
                    ->searchable()
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable(),
                TextColumn::make('duration')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('timestamp')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->striped()
        ;
    }
    protected static function countStatus($record, string $status): int
    {
        return RobotSysBrowser::where(DB::raw('trim(UPPER(status))'), trim($status))
            ->where(DB::raw('trim(UPPER(company))'), trim(strtoupper($record->entity)))
            ->count();
    }
}
