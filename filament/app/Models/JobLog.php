<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobLog extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'job_logs';

    // Kolom yang boleh diisi massal
    protected $fillable = [
        'start_date',
        'end_date',
        'duration',
        'job_id',
        'timestamp_extracted',
        'dialog_title',
        'error_details_log',
    ];
}
