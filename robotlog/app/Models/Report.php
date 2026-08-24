<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['title', 'sql_queries', 'parameters', 'mrt_file'];

    protected $casts = [
        'sql_queries' => 'array',
        'parameters' => 'array',
    ];
}
