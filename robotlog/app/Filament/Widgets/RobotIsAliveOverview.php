<?php

namespace App\Filament\Widgets;

use App\Models\RobotIsALive;
use Carbon\Carbon;
use Filament\Schemas\Components\Component;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RobotIsAliveOverview extends BaseWidget
{
    protected ?string $pollingInterval = '15s';

    public function getSectionContentComponent(): Component
    {
        return parent::getSectionContentComponent()
            ->extraAttributes(['class' => 'robot-overview-grid-container']);
    }

    protected function getCards(): array
    {
        $now = Carbon::now();
        $activeThreshold = $now->copy()->subMinutes(5);

        $totalRobots = RobotIsALive::count();
        $activeRobots = RobotIsALive::whereNotNull('robot_last_activity_at')
            ->where('robot_last_activity_at', '>=', $activeThreshold)
            ->count();
        $inactiveRobots = max($totalRobots - $activeRobots, 0);

        $latestRobot = RobotIsALive::query()
            ->orderByDesc('robot_last_activity_at')
            ->first();

        $lastActivityLabel = $latestRobot && $latestRobot->robot_last_activity_at
            ? Carbon::parse($latestRobot->robot_last_activity_at)->diffForHumans($now)
            : 'Belum ada data';

        return [
            Stat::make('Robot aktif', (string) $activeRobots)
                ->description($activeRobots > 0 ? 'Dalam 5 menit terakhir' : 'Tidak ada robot aktif')
                ->icon('heroicon-o-check-circle')
                ->descriptionIcon('heroicon-o-heart')
                ->extraAttributes(['class' => 'robot-overview-same-bg'])
                ->color('active'),

            Stat::make('Robot tidak aktif', (string) $inactiveRobots)
                ->description('Melebihi interval 5 menit')
                ->icon('heroicon-o-x-circle')
                ->descriptionIcon('heroicon-o-exclamation-triangle')
                ->extraAttributes(['class' => 'robot-overview-same-bg'])
                ->color('inactive'),

            Stat::make('Terakhir aktif', $latestRobot?->robot_name ?? 'Tidak ada')
                ->description($lastActivityLabel)
                ->icon('heroicon-o-bolt')
                ->descriptionIcon('heroicon-o-clock')
                ->extraAttributes(['class' => 'robot-overview-same-bg'])
                ->color('latest'),
        ];
    }
}
