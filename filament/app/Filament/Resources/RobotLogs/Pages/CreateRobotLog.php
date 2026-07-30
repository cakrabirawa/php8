<?php

namespace App\Filament\Resources\RobotLogs\Pages;

use App\Filament\Resources\RobotLogs\RobotLogResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRobotLog extends CreateRecord
{
    protected static string $resource = RobotLogResource::class;
    protected function getHeaderActions(): array
    {
        return [
            // Kosongkan di sini untuk menghilangkan tombol "New Job Log"
        ];
    }
}
