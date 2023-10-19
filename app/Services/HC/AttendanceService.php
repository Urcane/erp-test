<?php

namespace App\Services\HC;

use App\Utils\ErrorHandler;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\InvariantError;

class AttendanceService
{


    public function __construct()
    {
        $this->errorHandler = new ErrorHandler;
    }

    public function FunctionName()
    {

    }
}
