<?php

namespace App\Http\Controllers;

use App\Console\Commands\MakeAttendance;
use Illuminate\Http\Request;

class Tests extends Controller
{
    public function test()
    {
        $start = microtime(true);

        $attendance = new MakeAttendance();
        $attendance->handle();

        $end = microtime(true);

        return response()->json([
            'execution_time' => ($end - $start) . " seconds.",
            'memory_usage' => (memory_get_usage(true) / 1024 / 1024) . " MB"
        ]);
    }
}
