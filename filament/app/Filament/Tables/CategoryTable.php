<?php

namespace App\Filament\Tables;

use App\Models\Category;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class CategoryTable
{
  public static function configure(Table $table): Table
  {
    return $table
      ->query(Category::query())
      ->columns([
        TextColumn::make('name')
          ->label('Nama Kategori')
          ->searchable()
          ->sortable(),
        TextColumn::make('parent.name')
          ->label('Induk Kategori')
          ->placeholder('Kategori Utama'),
      ]);
  }
}
