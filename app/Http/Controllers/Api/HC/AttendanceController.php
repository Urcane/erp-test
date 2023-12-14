<?php

namespace App\Http\Controllers\Api\HC;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utils\ErrorHandler;

use App\Constants;

use App\Exceptions\InvariantError;
use App\Exceptions\NotFoundError;
use App\Models\Attendance\GlobalDayOff;
use App\Models\Attendance\UserAttendance;

class AttendanceController extends Controller
{

    private $constants;

    public function __construct()
    {
        $this->constants = new Constants();
    }
}
