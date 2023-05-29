<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function indexLead()
    {
        return view('cmt-customer.lead.index');
    }
}
