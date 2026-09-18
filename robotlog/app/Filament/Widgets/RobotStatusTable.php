<?php

namespace App\Filament\Widgets;

use App\Models\RobotIsALive;
use Carbon\Carbon;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class RobotStatusTable extends TableWidget
{
    protected static ?int $sort = 2;

    protected string $view = 'filament.widgets.robot-status-table';
    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return RobotIsALive::query()->orderByDesc('robot_last_activity_at');
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('robot_name')
                ->label('Robot')
                ->searchable()
                ->sortable(),

            TextColumn::make('robot_last_activity_at')
                ->label('Terakhir aktif')
                ->dateTime('d/m/y H:i:s')
                ->sortable(),

            TextColumn::make('status')
                ->label('Status')
                ->getStateUsing(function ($record) {
                    if (! $record->robot_last_activity_at) {
                        return 'Tidak aktif';
                    }

                    $lastActivity = Carbon::parse($record->robot_last_activity_at);
                    $diffMinutes = $lastActivity->diffInMinutes(Carbon::now(), false);

                    return $diffMinutes <= 5 ? 'Aktif' : 'Tidak aktif';
                })
                ->badge()
                ->color(fn($state) => $state === 'Aktif' ? 'active' : 'inactive')
                ->icon(fn($state) => $state === 'Aktif' ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle'),

            TextColumn::make('delay')
                ->label('Selisih')
                ->getStateUsing(function ($record) {
                    if (! $record->robot_last_activity_at) {
                        return 'Belum ada data';
                    }

                    return Carbon::parse($record->robot_last_activity_at)->diffForHumans(Carbon::now(), ['short' => true, 'parts' => 2]);
                })
                ->sortable(false),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())
            ->columns($this->getTableColumns())
            ->defaultSort('robot_last_activity_at', 'desc');
    }
}
