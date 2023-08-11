<?php

namespace App\Http\Controllers\HC\Settings\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee\SubBranch;

class BranchController extends Controller
{
    public function index() {
        return view("hc.cmt-settings.company.branch.branch");
    }

    public function create() {
        $dataParent = SubBranch::all();
        return view("hc.cmt-settings.company.branch.create-update-branch", compact(['dataParent']));
    }
}
