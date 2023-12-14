<?php

namespace App\Http\Controllers\ProjectManagement;

use App\Http\Controllers\Controller;
use App\Models\ProjectManagement\WorkActivity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index($work_list_id)
    {
        $workActivity = WorkActivity::where("work_list_id", $work_list_id)->with("user", "attachments")->orderBy('id', "desc")->get();

        return view('cmt-promag.pages.activity', compact(["work_list_id", "workActivity"]));
    }
}
