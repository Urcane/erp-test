<?php

namespace App\Http\Controllers\Finance\Inventory\Masterdata;

use App\Constants;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class MasterdataController extends Controller
{
    abstract public function create(Request $request);
    abstract public function update(Request $request);
    abstract public function getData();
    abstract public function getTable(Request $request);
}
