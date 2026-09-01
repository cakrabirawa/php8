<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RobotErrorScreenshot;
use App\Models\RobotIsALive;
use App\Models\RobotJobCount;
use App\Models\RobotJobLog;
use App\Models\RobotPosting;
use App\Models\RobotRecoveryInvoice;
use App\Models\RobotSysBrowser;
use Illuminate\Http\Request;

class RobotUtils extends Controller
{
    public function clean_robot_table(Request $request)
    {
        RobotSysBrowser::truncate();
        RobotPosting::truncate();
        RobotErrorScreenshot::truncate();
        RobotIsALive::truncate();
        RobotJobCount::truncate();
        RobotJobLog::truncate();
        RobotRecoveryInvoice::truncate();
        return response()->json(['message' => 'All robot-related tables have been cleaned.'], 200);
    }
}
