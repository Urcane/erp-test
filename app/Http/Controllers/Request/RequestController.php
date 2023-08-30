<?php

namespace App\Http\Controllers\Request;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Utils\ErrorHandler;
use Illuminate\Http\Request;

abstract class RequestController extends Controller
{
    protected $errorHandler;
    protected $constants;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
        $this->constants = new Constants();
    }

    abstract public function makeRequest(Request $request);
    abstract public function showRequestTableById(Request $request);
}
