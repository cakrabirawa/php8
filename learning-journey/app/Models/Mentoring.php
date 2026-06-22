<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mentoring extends Model
{
    protected $fillable = [
        'employee_id',
        'mentor_name',
        'store_id',
        'notes',
        'notes_hr',
        'status',
        'score',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'score',
    ];

    const UPDATED_AT = null;

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
