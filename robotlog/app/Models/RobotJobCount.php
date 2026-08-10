<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function sysBrowsers(): HasMany
    {
        return $this->hasMany(RobotSysBrowser::class, 'company', 'entity');
    }
}
