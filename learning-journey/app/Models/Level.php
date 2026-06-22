<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = 'levels';
    protected $fillable = ['name'];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}


