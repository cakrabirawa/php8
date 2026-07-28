<?php

namespace App\Filament\Resources\JobLogs\Pages;

use App\Filament\Resources\JobLogs\JobLogResource;
use Filament\Resources\Pages\CreateRecord;

class CreateJobLog extends CreateRecord
{
    protected static string $resource = JobLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Kosongkan di sini untuk menghilangkan tombol "New Job Log"
        ];
    }
}
