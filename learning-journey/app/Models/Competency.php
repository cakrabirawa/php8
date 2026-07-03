<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competency extends Model
{
    protected $fillable = ['name','slug'];

    public function idps()
    {
        return $this->hasMany(IndividualDevelopmentPlan::class);
    }
}