<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdpTask extends Model
{
    protected $table = 'idp_tasks';

    protected $fillable = [
        'idp_id',
        'category',
        'task',
        'notes_ss',
        'target_date',
        'evidence_link',
        'feedback_sm',
        'feedback_hr',
        'status'
    ];

    protected $casts = [
        'target_date' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function idp()
    {
        return $this->belongsTo(IndividualDevelopmentPlan::class, 'idp_id');
    }
}