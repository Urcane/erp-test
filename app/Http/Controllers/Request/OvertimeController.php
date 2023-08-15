<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rule;

use App\Utils\ErrorHandler;
use App\Constants;
use App\Exceptions\AuthorizationError;
use App\Exceptions\InvariantError;
use App\Exceptions\NotFoundError;
use App\Models\Attendance\UserAttendanceRequest;
use App\Models\Attendance\UserAttendance;
use App\Models\Attendance\UserShiftRequest;

class OvertimeController extends Controller
{
    private $errorHandler;
    private $constants;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
        $this->constants = new Constants();
    }
}
