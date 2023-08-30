<?php

namespace App\Http\Controllers\Sales\Opportunity\Quotation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class QuotationController extends Controller{
    
    function index() {
    return view('cmt-opportunity.quotation.pages.survey-request');
    }
}
