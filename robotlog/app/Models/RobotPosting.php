<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
    ];

    protected $casts = [
        'invoice_received_date' => 'date',
        'created_date_and_time' => 'datetime',
        'c_ready_to_post_created_datetime' => 'datetime',
        'imported_invoice_amount' => 'decimal:2',
    ];

    public function robotLogs(): HasMany
    {
        return $this->hasMany(RobotLog::class, 'invoice_no', 'invoice_number');
    }

    public function latestRobotLog(): HasOne
    {
        return $this->hasOne(RobotLog::class, 'invoice_no', 'invoice_number')
            ->latestOfMany(); 
    }
}
