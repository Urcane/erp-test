<?php

namespace App\Http\Controllers\HC\Settings\TimeManagement;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Utils\ErrorHandler;
use Illuminate\Http\Request;

abstract class TimeManagementController extends Controller
{
    protected $constants;

    public function __construct()
    {
        $this->constants = new Constants();
    }
    abstract public function index();
    abstract public function getTable(Request $request);
    abstract public function destroy(Request $request);
}
