<?php

namespace App\Http\Controllers\ProjectManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index($work_list_id)
    {
        return view('cmt-promag.pages.activity', compact("work_list_id"));
    }
}
