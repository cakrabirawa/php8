<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RobotJobLog extends Model
{
    use HasFactory;

    protected $table = 'robot_job_logs';

    protected $fillable = [
        'batch_job_id',
        'company',
        'status',
        'caption',
        'start_date_time',
        'end_date_time',
        'info',
        'invoice_no',
    ];

    protected $casts = [
        'start_date_time' => 'datetime:Y-m-d H:i:s',
        'end_date_time' => 'datetime:Y-m-d H:i:s',
    ];

    public function robotSysBrowser(): BelongsTo
    {
        return $this->belongsTo(RobotSysBrowser::class, 'batch_job_id', 'batch_job_id');
    }
}
