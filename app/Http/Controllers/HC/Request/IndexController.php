<?php

namespace App\Http\Controllers\HC\Request;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Division;
use App\Utils\ErrorHandler;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private $constants;

    public function __construct()
    {
        $this->constants = new Constants();
    }

    public function index()
    {
        $approveStatus = array_slice($this->constants->approve_status, 0, 3);
        $dataDivision = Division::all();
        $dataDepartment = Department::all();

        return view('hc.cmt-request.index', compact(['approveStatus', 'dataDivision', 'dataDepartment']));
    }
}
