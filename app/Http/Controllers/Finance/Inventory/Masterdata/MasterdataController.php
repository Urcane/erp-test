<?php

namespace App\Http\Controllers\Finance\Inventory\Masterdata;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Utils\ErrorHandler;
use Illuminate\Http\Request;

abstract class MasterdataController extends Controller
{
    protected $errorHandler;
    protected $constants;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
        $this->constants = new Constants();
    }

    abstract public function create(Request $request);
    abstract public function update(Request $request);
    abstract public function getData();
    abstract public function getTable(Request $request);
}
