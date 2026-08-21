<?php

namespace App\Filament\Resources\RobotErrorScreenshots\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RobotErrorScreenshotForm
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        TextInput::make('nama_robot')
          ->label('Nama Robot')
          ->required()
          ->maxLength(50),

        TextInput::make('file_name')
          ->label('Nama File')
          ->required()
          ->maxLength(255),
      ]);
  }
}
