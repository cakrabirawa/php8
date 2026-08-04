<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RobotSysBrowser extends Model
{
    protected $table = 'robot_logs';

    protected $fillable = [
        'timestamp',
        'automatic_transaction',
        'batch_job_id',
        'caption',
        'invoice_no',
        'company',
        'server_id',
        'status',
        'start_date',
        'end_date',
    ];
}
