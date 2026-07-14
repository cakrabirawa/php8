<?php

namespace App\Filament\Resources;

use Filament\Resources\Resource;
use Illuminate\Support\Str;

class BaseResource extends Resource
{
  // Otomatis membuat huruf kapital mengikuti nama modelnya
  // public static function getModelLabel(): string
  // {
  //   return Str::ucfirst(Str::headline(class_basename(static::getModel())));
  // }

  // public static function getPluralModelLabel(): string
  // {
  //   return Str::ucfirst(Str::headline(Str::plural(class_basename(static::getModel()))));
  // }
}
