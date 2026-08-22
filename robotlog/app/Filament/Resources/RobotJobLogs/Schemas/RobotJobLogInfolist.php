<?php

namespace App\Filament\Resources\RobotJobLogs\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class RobotJobLogInfolist
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        TextEntry::make('job_id')->label('Job ID'),
        TextEntry::make('robotSysBrowser.invoice_no')->label('Invoice No')->default('-'),
        TextEntry::make('dialog_title')->label('Dialog Title'),
        TextEntry::make('start_date')->label('Start Date')->dateTime('d/m/y H:i:s'),
        TextEntry::make('end_date')->label('End Date')->dateTime('d/m/y H:i:s'),
        TextEntry::make('duration')->label('Duration'),
        TextEntry::make('timestamp_extracted')->label('Timestamp Extracted')->dateTime('d/m/y H:i:s'),
        TextEntry::make('error_details_log')->label('Error Details Log')->columnSpanFull(),
      ]);
  }
}
