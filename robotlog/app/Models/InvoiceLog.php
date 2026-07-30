<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceLog extends Model
{
    protected $fillable = [
        'invoice_no',
        'status',
        'time_stamp',
    ];

    protected $casts = [
        'time_stamp' => 'datetime',
    ];
}
