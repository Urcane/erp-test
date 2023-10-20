<?php

namespace App\Http\Controllers\Api\HC\Request;

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
    abstract public function getRequests(Request $request);
    abstract public function getRequestById(Request $request);
    abstract public function updateRequestStatusById(Request $request);
}
