<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RobotJobCount extends Model
{
    protected $table = 'robot_job_counts';

    protected $fillable = [
        'start_date',
        'end_date',
        'duration',
        'timestamp',
        'count',
        'entity',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'timestamp' => 'datetime',
        'count' => 'integer',
    ];
}
