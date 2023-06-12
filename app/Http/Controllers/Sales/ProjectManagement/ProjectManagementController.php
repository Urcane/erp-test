<?php

namespace App\Http\Controllers\Sales\ProjectManagement;

use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use Illuminate\Http\Request;

class ProjectManagementController extends Controller
{
    public function index()
    {
        return view('cmt-customer.promag.index');
    }
    
    public function detail(Request $request)
    {
        return view('cmt-customer.promag.pages.overview');
    }

    public function files(Request $request)
    {
        return view('cmt-customer.promag.pages.files');
    }

    public function taskLists(Request $request)
    {
        return view('cmt-customer.promag.pages.task-lists');
    }
}
