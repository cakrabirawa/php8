<?php

namespace App\Filament\Widgets;

use App\Models\RobotPosting;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Blade;

class RobotPostingStatusOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected ?string $pollingInterval = '30s';

    protected function getCards(): array
    {
        $postingSuccessCount = RobotPosting::query()
            ->where('final_status', 'POSTING SUCCESS')
            ->count();
        $latestSuccessfulPosting = RobotPosting::query()
            ->where('final_status', 'POSTING SUCCESS')
            ->whereNotNull('final_status_checked_date')
            ->orderByDesc('final_status_checked_date')
            ->first(['final_status_checked_date']);
        $failedToPostCount = RobotPosting::query()
            ->where('final_status', 'FAILED TO POST')
            ->count();

        $lastSuccessfulPosting = $latestSuccessfulPosting?->final_status_checked_date
            ?->format('d/m/Y H:i:s') ?? 'Belum ada data';
        $successIcon = Blade::render(
            '<x-heroicon-o-check-circle style="width: 1rem; height: 1rem; display: inline-block; vertical-align: middle; color: rgb(16 185 129);" />'
        );

        return [
            Stat::make('POSTING SUCCESS', (string) $postingSuccessCount)
                ->description(new HtmlString('Total invoice berhasil diposting '.$successIcon.'<br>Terakhir selesai: '.$lastSuccessfulPosting))
                ->icon('heroicon-o-document-check')
                ->color('success'),

            Stat::make('FAILED TO POST', (string) $failedToPostCount)
                ->description('Total invoice gagal diposting')
                ->descriptionIcon('heroicon-o-exclamation-triangle')
                ->icon('heroicon-o-document-minus')
                ->color('danger'),
        ];
    }
}
