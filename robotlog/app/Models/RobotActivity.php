<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RobotActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'robot_name',
        'robot_last_activity_at',
        'robot_diff_time_current',
    ];
}
