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
        'index_baris',
        'invoice_number',
        'company',
        'invoice_account',
        'name',
        'purchase_order',
        'invoice_received_date',
        'imported_invoice_amount',
        'last_match_status',
        'variance_approved',
        'product_receipt',
        'c_status',
        'c_ca_csa_number',
        'c_pool',
        'c_intercompany_sales_invoice',
        'c_tax_invoice_number',
        'c_is_total_updated',
        'c_is_split_invoice',
        'c_is_split_invoice_return',
        'created_date_and_time',
        'c_ready_to_post_created_datetime',
        'final_status',
        'final_status_checked_date',
        'attempt_posting',
        'attempt_recovery',
        'sent_email_to_support_status',
        'sent_email_to_support_date',
    ];

    protected $casts = [
        'invoice_received_date' => 'date',
        'created_date_and_time' => 'datetime',
        'c_ready_to_post_created_datetime' => 'datetime',
        'final_status_checked_date' => 'datetime',
        'imported_invoice_amount' => 'decimal:2',
    ];

    public function robotLogs(): HasMany
    {
        return $this->hasMany(RobotSysBrowser::class, 'invoice_no', 'invoice_number');
    }

    public function latestRobotLog(): HasOne
    {
        return $this->hasOne(RobotSysBrowser::class, 'invoice_no', 'invoice_number')
            ->latestOfMany();
    }

    public function getLastJobErrorDetailsLogAttribute(): ?string
    {
        if (blank($this->invoice_number)) {
            return null;
        }

        $batchJobId = DB::table('robot_sys_browser')
            ->whereRaw('upper(TRIM(invoice_no)) = upper(TRIM(?))', [$this->invoice_number])
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
