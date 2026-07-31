<?php

namespace App\Filament\Resources\RobotActivities\Pages;

use App\Filament\Resources\RobotActivities\RobotActivityResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRobotActivity extends CreateRecord
{
    protected static string $resource = RobotActivityResource::class;
    protected function getHeaderActions(): array
    {
        return [
            // Kosongkan array ini agar tombol "New Robot" / "Create" hilang dari pojok kanan atas
        ];
    }
}
