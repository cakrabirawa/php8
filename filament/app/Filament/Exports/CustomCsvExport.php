<?php

namespace App\Filament\Exports;

use Filament\Actions\BulkAction as ActionsBulkAction;
use Filament\Actions\BulkActionGroup as ActionsBulkActionGroup;
use Illuminate\Database\Eloquent\Collection;

class CustomCsvExport
{
  public static function make(): ActionsBulkActionGroup
  {
    return ActionsBulkActionGroup::make([
      ActionsBulkAction::make('export_csv')
        ->label('Ekspor ke CSV')
        ->icon('heroicon-o-arrow-down-tray')
        ->color('success')
        ->action(function (Collection $records, $livewire) {
          $modelName = strtolower(class_basename($records->first()));
          $fileName = $modelName . '-export-' . date('Y-m-d') . '.csv';

          return response()->streamDownload(function () use ($records, $livewire) {
            $handle = fopen('php://output', 'w');

            // Header Tabel
            $columns = $livewire->getTable()->getColumns();
            $headers = [];
            foreach ($columns as $column) {
              $headers[] = $column->getLabel() ?? $column->getName();
            }
            fputcsv($handle, $headers);

            // Baris Data
            foreach ($records as $record) {
              $row = [];
              foreach ($columns as $column) {
                $name = $column->getName();
                $row[] = data_get($record, $name);
              }
              fputcsv($handle, $row);
            }

            fclose($handle);
          }, $fileName, [
            'Content-Type' => 'text/csv',
          ]);
        })
    ]);
  }
}
