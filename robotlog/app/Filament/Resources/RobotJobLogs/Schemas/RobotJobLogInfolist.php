<?php

namespace App\Filament\Resources\RobotJobLogs\Schemas;

use Carbon\CarbonInterface;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Illuminate\Support\Carbon;

class RobotJobLogInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('batch_job_id')->label('Batch Job Id')->color('warning'),
                TextEntry::make('robotSysBrowser.invoice_no')->label('Invoice No')->default('-')->color('success'),
                TextEntry::make('caption')->label('Caption'),
                TextEntry::make('info')->label('Info'),
                TextEntry::make('start_date_time')->label('Start Date')->dateTime('d/m/y H:i:s'),
                TextEntry::make('end_date_time')->label('End Date')->dateTime('d/m/y H:i:s'),
                TextEntry::make('duration')->label('Duration')->getStateUsing(function ($record) {
                    if (!$record->start_date_time || !$record->end_date_time) {
                        return '-';
                    }
                    $start = Carbon::parse($record->start_date_time);
                    $end = Carbon::parse($record->end_date_time);
                    return $start->diffForHumans($end, [
                        'syntax' => CarbonInterface::DIFF_ABSOLUTE,
                        'short' => true,
                        'parts' => 2,
                    ]);
                })
            ]);
    }
}
