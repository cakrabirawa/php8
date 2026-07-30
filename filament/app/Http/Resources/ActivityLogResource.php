<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityLogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'data' => [
                'start_date' => $this->start_date?->toDateTimeString(),
                'end_date' => $this->end_date?->toDateTimeString(),
                'duration' => $this->duration,
                'timestamp' => $this->timestamp?->toDateTimeString(),
                'count' => (int) $this->count,
                'entity' => $this->entity,
                'detail' => $this->detail ?? [],
            ]
        ];
    }

    // Menghilangkan pembungkus ganda jika Laravel otomatis menambahkan 'data' di luar
    public static $wrap = null;
}
