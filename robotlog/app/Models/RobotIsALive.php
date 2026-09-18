<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RobotIsALive extends Model
{
    use HasFactory;

    protected $table = 'robot_is_alive';

    protected $fillable = [
        'robot_name',
        'robot_last_activity_at',
        'robot_diff_time_current',
    ];
}
