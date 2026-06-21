<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    // Mengizinkan kolom ini untuk diisi data secara massal
    protected $fillable = ['title', 'is_completed'];
}
