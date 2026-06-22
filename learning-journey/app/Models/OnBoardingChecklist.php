<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnboardingChecklist extends Model
{
    use HasFactory;

    protected $table = 'onboarding_checklists';

    protected $casts = [
    'checklist_json' => 'array',
    ];

    protected $fillable = [
        'employee_id',
        'filled_by',
        'month',
        'week',
        'score',
        'checklist_json', 
        'notes_store_manager',
        'status',
        'notes_hr',
        'notes_ss'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    public function filledBy()
    {
        return $this->belongsTo(Employee::class, 'filled_by', 'employee_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}





