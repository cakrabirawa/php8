<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'start_date',
        'end_date',
        'duration',
        'timestamp',
        'count',
        'entity',
        // 'detail',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'timestamp' => 'datetime',
        // 'detail' => 'array', // Mengonversi otomatis json ke array PHP
        'count' => 'integer',
    ];
}
