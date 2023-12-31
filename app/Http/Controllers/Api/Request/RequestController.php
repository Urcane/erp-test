<?php

namespace App\Http\Controllers\Api\Request;

use App\Constants;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class RequestController extends Controller
{
    protected $constants;

    public function __construct()
    {
        $this->constants = new Constants();
    }
    abstract public function getRequest(Request $request);
    abstract public function getRequestById(Request $request);
    abstract public function makeRequest(Request $request);
    abstract public function cancelRequest(Request $request);
}
