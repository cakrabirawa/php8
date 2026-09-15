<?php

namespace App\Filament\Widgets;

use App\Models\RobotPosting;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class RobotActivityWeeklyChart extends ChartWidget
{
  protected ?string $heading = 'Posting Invoice 7 Hari Terakhir';

  protected static ?int $sort = 3;

  protected int | string | array $columnSpan = 'full';

  protected ?string $pollingInterval = '60s';

  protected function getData(): array
  {
    $today = Carbon::today();
    $startDate = $today->copy()->subDays(6);

    $postingsByStatusAndDate = RobotPosting::query()
      ->whereIn('final_status', ['POSTING SUCCESS', 'FAILED TO POST'], 'and', false)
      ->whereBetween('final_status_checked_date', [
        $startDate->copy()->startOfDay(),
        $today->copy()->endOfDay(),
      ], 'and', false)
      ->get(['final_status', 'final_status_checked_date'])
      ->groupBy('final_status')
      ->map(fn($items) => $items
        ->groupBy(fn(RobotPosting $posting): string => Carbon::parse($posting->final_status_checked_date)->toDateString())
        ->map(fn($items): int => $items->count()));

    $labels = [];
    $postingSuccessValues = [];
    $failedToPostValues = [];

    for ($date = $startDate->copy(); $date->lte($today); $date->addDay()) {
      $key = $date->toDateString();

      $labels[] = $date->translatedFormat('D, d M');
      $postingSuccessValues[] = (int) ($postingsByStatusAndDate['POSTING SUCCESS'][$key] ?? 0);
      $failedToPostValues[] = (int) ($postingsByStatusAndDate['FAILED TO POST'][$key] ?? 0);
    }

    return [
      'datasets' => [
        [
          'label' => 'POSTING SUCCESS',
          'data' => $postingSuccessValues,
          'borderColor' => '#22c55e',
          'backgroundColor' => 'rgba(34, 197, 94, 0.18)',
          'fill' => true,
          'tension' => 0.35,
        ],
        [
          'label' => 'FAILED TO POST',
          'data' => $failedToPostValues,
          'borderColor' => '#ef4444',
          'backgroundColor' => 'rgba(239, 68, 68, 0.18)',
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
