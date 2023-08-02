<?php

namespace App\Http\Controllers\attendance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    function index() {
        return view('hc.cmt-attendance.index');
    }
}
