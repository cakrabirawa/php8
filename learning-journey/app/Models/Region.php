<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Region extends Model
{
    protected $fillable = ['name'];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    

    public function getShortNameAttribute()
    {
        $name = $this->name;

        // Hapus kata "Division" di belakang
        $name = preg_replace('/\s+Division$/i', '', $name);

        // Hapus kata "Regional" di depan (kalau mau)
        $name = preg_replace('/^Regional\s+/i', '', $name);

        return trim($name);
    }
}

