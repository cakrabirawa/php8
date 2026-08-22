<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class RobotJobLog extends Model
{
    use HasFactory;

    protected $table = 'robot_job_logs';

    protected $fillable = [
        'start_date',
        'end_date',
        'duration',
        'job_id',
        'timestamp_extracted',
        'dialog_title',
        'error_details_log',
    ];

    protected $casts = [
        'start_date' => 'datetime:Y-m-d H:i:s',
        'end_date' => 'datetime:Y-m-d H:i:s',
        'timestamp_extracted' => 'datetime:Y-m-d H:i:s',
    ];

    public function robotSysBrowser(): BelongsTo
    {
        return $this->belongsTo(RobotSysBrowser::class, 'job_id', 'batch_job_id');
    }
}
