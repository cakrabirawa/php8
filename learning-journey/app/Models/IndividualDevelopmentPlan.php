<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndividualDevelopmentPlan extends Model
{
    protected $table = 'individual_development_plans';

    protected $fillable = [
        'employee_id',
        'competency_id',
        'current_level',
        'target_level',
        'target_idp',
        'first_meeting_date',
        'mentor_name',
        'status'
    ];

    protected $casts = [
        'first_meeting_date' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    // Employee pemilik IDP
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    // Task-task dalam IDP
    public function tasks()
    {
        return $this->hasMany(IdpTask::class, 'idp_id');
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER
    |--------------------------------------------------------------------------
    */

    public static function levels()
    {
        return [
            1 => 'Lone Ranger',
            2 => 'Team Player',
            3 => 'Team Leader',
            4 => 'Synergy Maker',
            5 => 'Collaborator',
            6 => 'Ecosystem Builder',
        ];
    }


    public function competency()
    {
        return $this->belongsTo(Competency::class);
    }
}