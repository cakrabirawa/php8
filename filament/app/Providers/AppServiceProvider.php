<?php

namespace App\Providers;

use Filament\Forms\Components\DatePicker;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        TextColumn::macro('humanFormat', function () {
            /** @var TextColumn $column */
            $column = $this;
            return $column->sortable()
                ->formatStateUsing(function ($state) {
                    if (! $state) {
                        return '-';
                    }
                    $date = Carbon::parse($state)->timezone('Asia/Jakarta');
                    $today = Carbon::now('Asia/Jakarta');
                    if ($date->format('Y-m-d') === $today->format('Y-m-d')) {
                        return $date->diffForHumans();
                    }
                    return $date->translatedFormat('d-m-Y H:i:s');
                });
        });

        Resource::macro('getModelLabel', function () {
            /** @var Resource $this */
            $modelClass = static::getModel();

            // Jika model class tidak ditemukan (seperti pada beberapa halaman internal), gunakan default
            if (! $modelClass) {
                return Str::headline(class_basename(static::class));
            }

            return Str::ucfirst(Str::headline(class_basename($modelClass)));
        });

        Resource::macro('getPluralModelLabel', function () {
            /** @var Resource $this */
            $modelClass = static::getModel();

            if (! $modelClass) {
                return Str::headline(Str::plural(class_basename(static::class)));
            }

            return Str::ucfirst(Str::headline(Str::plural(class_basename($modelClass))));
        });

        DatePicker::configureUsing(function (DatePicker $component) {
            $component
                ->displayFormat('d/m/Y')
                ->format('Y-m-d');
        });
    }
}
