<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('home');
    }

    public function import(Request $request)
    {
        Excel::import(new UsersImport, $request->import);
        return redirect()->back();
    }
}
