<?php

namespace App\Http\Controllers\ProjectManagement;

use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use Illuminate\Http\Request;

class ProjectManagementController extends Controller
{
    public function index()
    {
        return view('cmt-promag.index');
    }
    
    public function detail(Request $request)
    {
        return view('cmt-promag.pages.overview');
    }

    public function files(Request $request)
    {
        return view('cmt-promag.pages.files');
    }

    public function taskLists(Request $request)
    {
        return view('cmt-promag.pages.task-lists');
    }
}
