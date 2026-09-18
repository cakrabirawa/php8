<?php

namespace App\Filament\Exports;

use Filament\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;

class CustomCsvExport
{
    public static function makeCSV(): BulkAction
    {
        return BulkAction::make('export_csv')
            ->label('Ekspor ke CSV')
            ->icon('heroicon-o-arrow-down-tray')
            ->color('success')
            ->action(function (Collection $records, $livewire) {
                if ($records->isEmpty()) {
                    return;
                }
                $modelName = strtolower(class_basename($records->first()));
                $fileName = $modelName . '-export-' . date('Y-m-d') . '.csv';
                return response()->streamDownload(function () use ($records, $livewire) {
                    $handle = fopen('php://output', 'w');
                    $columns = $livewire->getTable()->getColumns();
                    $headers = [];
                    foreach ($columns as $column) {
                        $headers[] = $column->getLabel() ?? $column->getName();
                    }
                    fputcsv($handle, $headers);
                    foreach ($records as $record) {
                        $row = [];
                        foreach ($columns as $column) {
                            $name = $column->getName();
                            $row[] = $column->record($record)->getState();
                        }
                        fputcsv($handle, $row);
                    }

                    fclose($handle);
                }, $fileName, [
                    'Content-Type' => 'text/csv',
                    'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                ]);
            })
            ->deselectRecordsAfterCompletion();
    }

    public static function makeJson(): BulkAction
    {
        return BulkAction::make('export_json')
            ->label('Ekspor ke JSON')
            ->icon('heroicon-o-code-bracket')
            ->color('warning')
            ->action(function (Collection $records, $livewire) {
                if ($records->isEmpty()) {
                    return;
                }
                $modelName = strtolower(class_basename($records->first()));
                $fileName = $modelName . '-export-' . date('Y-m-d') . '.json';
                return response()->streamDownload(function () use ($records, $livewire) {
                    $columns = $livewire->getTable()->getColumns();
                    $jsonData = [];
                    foreach ($records as $record) {
                        $row = [];
                        foreach ($columns as $column) {
                            $key = $column->getName();
                            $row[$key] = $column->record($record)->getState();
                        }
                        $jsonData[] = $row;
                    }
                    echo json_encode($jsonData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                }, $fileName, [
                    'Content-Type' => 'application/json',
                    'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                ]);
            })
            ->deselectRecordsAfterCompletion();
    }
}
