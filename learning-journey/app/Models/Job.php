<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = ['section_id', 'name'];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}


