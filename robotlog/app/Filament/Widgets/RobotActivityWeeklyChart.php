<?php

namespace App\Filament\Widgets;

use App\Models\RobotIsALive;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class RobotActivityWeeklyChart extends ChartWidget
{
  protected ?string $heading = 'Aktivitas Robot 7 Hari Terakhir';

  protected static ?int $sort = 3;

  protected int | string | array $columnSpan = 'full';

  protected ?string $pollingInterval = '60s';

  protected function getData(): array
  {
    $today = Carbon::today();
    $startDate = $today->copy()->subDays(6);

    $activityByDate = RobotIsALive::query()
      ->whereBetween('robot_last_activity_at', [
        $startDate->copy()->startOfDay(),
        $today->copy()->endOfDay(),
      ], 'and', false)
      ->get(['robot_last_activity_at'])
      ->groupBy(fn(RobotIsALive $activity): string => Carbon::parse($activity->robot_last_activity_at)->toDateString())
      ->map(fn($items): int => $items->count());

    $labels = [];
    $values = [];

    for ($date = $startDate->copy(); $date->lte($today); $date->addDay()) {
      $key = $date->toDateString();

      $labels[] = $date->translatedFormat('D, d M');
      $values[] = (int) ($activityByDate[$key] ?? 0);
    }

    return [
      'datasets' => [
        [
          'label' => 'Jumlah aktivitas robot',
          'data' => $values,
          'borderColor' => '#22c55e',
          'backgroundColor' => 'rgba(34, 197, 94, 0.18)',
          'fill' => true,
          'tension' => 0.35,
        ],
      ],
      'labels' => $labels,
    ];
  }

  protected function getType(): string
  {
    return 'line';
  }
}
