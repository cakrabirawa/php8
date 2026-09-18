<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class RobotPosting extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_no',
        'company',
        'invoice_account',
        'name',
        'purchase_order',
        'final_status',
        'final_status_checked_date',
        'posting_attempt',
        'recovery_attempt',
        'sent_email_to_support_status',
        'sent_email_to_support_date',
    ];

    protected $casts = [
        'final_status_checked_date' => 'datetime',
        'sent_email_to_support_date' => 'datetime',
        'posting_attempt' => 'integer',
        'recovery_attempt' => 'integer',
    ];

    public function robotLogs(): HasMany
    {
        return $this->hasMany(RobotSysBrowser::class, 'invoice_no', 'invoice_no');
    }

    public function latestRobotLog(): HasOne
    {
        return $this->hasOne(RobotSysBrowser::class, 'invoice_no', 'invoice_no')
            ->latestOfMany();
    }

    public function getLastJobErrorDetailsLogAttribute(): ?string
    {
        if (blank($this->invoice_no)) {
            return null;
        }

        $batchJobId = DB::table('robot_sys_browser')
            ->whereRaw('upper(TRIM(invoice_no)) = upper(TRIM(?))', [$this->invoice_no])
            ->orderByDesc('id')
            ->value('batch_job_id');

        if (blank($batchJobId)) {
            return null;
        }

        return DB::table('robot_job_logs')
            ->where('job_id', $batchJobId)
            ->orderByDesc('timestamp_extracted')
            ->value('error_details_log');
    }
}
