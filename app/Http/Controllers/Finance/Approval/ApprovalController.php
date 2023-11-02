<?php

namespace App\Http\Controllers\Finance\Approval;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function index()
    {
        return view('finance.approval.index');
    }
}
