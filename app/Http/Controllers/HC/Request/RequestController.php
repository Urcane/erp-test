<?php

namespace App\Http\Controllers\HC\Request;

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
    abstract public function updateRequestStatus(Request $request);
    abstract public function getSummaries(Request $request);
    abstract public function getTable(Request $request);
}
