<?php

namespace App\Http\Controllers\Api\Request;

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

    abstract public function getRequest(Request $request);
    abstract public function getRequestById(Request $request);
    abstract public function makeRequest(Request $request);
}
