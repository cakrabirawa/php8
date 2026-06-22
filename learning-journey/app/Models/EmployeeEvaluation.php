<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeEvaluation extends Model
{
    protected $fillable = [
        'employee_id',

        'business_score',
        'behavior_score',
        'pa_score',

        'kpi_june',
        'kpi_december',
 

        'assessment_link'
    ];
  
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }


    public function store()
    {
        return $this->belongsTo(Store::class);
    }

}
