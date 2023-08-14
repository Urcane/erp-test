<?php

namespace App\Http\Controllers\HC\Settings\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyInfoController extends Controller
{
    public function index() {
        return view("hc.cmt-settings.company.company-info");
    }
}
