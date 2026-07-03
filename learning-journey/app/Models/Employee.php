<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DevelopmentScore;
use App\Models\EmployeeEvaluation;


class Employee extends Model
{
    protected $primaryKey = 'employee_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'employee_id',
        'name',
        'contract_type',
        'region_id',
        'store_id',
        'section_id',
        'job_id',
        'birthday',
        'initial_employment_date',
        'joining_date',
        'permanent_date',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function mentorings()
    {
        return $this->hasMany(Mentoring::class, 'employee_id', 'employee_id');
    }
    
    public function introduction()
    {
        return $this->hasOne(Introduction::class, 'nik', 'employee_id');
    }

    public function onboardingChecklists()
    {
        return $this->hasMany(OnboardingChecklist::class, 'employee_id', 'employee_id');
    }

    
    public function developmentScore()
    {
        return $this->hasOne(
            DevelopmentScore::class,
            'employee_id',   
            'employee_id'    
        );
    }

    public function evaluation()
    {
        return $this->hasOne(EmployeeEvaluation::class, 'employee_id');
    }

    public function getOnboardingProgressAttribute()
    {
        if (!$this->relationLoaded('onboardingChecklists')) {
            $this->load('onboardingChecklists');
        }

        if ($this->onboardingChecklists->contains(fn ($c) => in_array($c->month, [0]))) {
            return '6/6';
        }

        $grouped = $this->onboardingChecklists
            ->whereBetween('month', [1, 6])
            ->groupBy('month');

        $approvedMonths = 0;

        foreach ($grouped as $items) {
            if (
                $items->count() === 4 &&
                $items->every(fn ($i) => $i->status === 'approved')
            ) {
                $approvedMonths++;
            }
        }

        return $approvedMonths . '/6';
    }


    public function getApprovedMentoringCountAttribute()
    {
        return $this->mentorings
            ->where('status', 'verified')
            ->count();
    }

}
