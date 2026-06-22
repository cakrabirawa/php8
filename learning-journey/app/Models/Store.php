<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = ['id','region_id', 'name', 'user_id'];
    public $incrementing = false;
    protected $keyType = 'int';
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

