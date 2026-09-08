<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RobotSysBrowser extends Model
{
    protected $table = 'robot_sys_browser';

    protected $fillable = [
        'timestamp',
        'batch_job_id',
        'caption',
        'invoice_no',
        'company',
        'status',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'timestamp' => 'datetime',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
}
