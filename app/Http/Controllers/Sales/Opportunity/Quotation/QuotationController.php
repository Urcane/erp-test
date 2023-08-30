<?php

namespace App\Http\Controllers\Sales\Opportunity\Quotation;

use App\Services\Sales\Opportunity\Quotation\QuotationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuotationController
{
    protected $quotationService;

    function __construct(QuotationService $quotationService) {
        $this->quotationService = $quotationService;
    }

    function index() { 
        return view('');      
    }

    function getDatatable(Request $request) : JsonResponse  {
        if ($request->ajax()) {
            return $this->quotationService->renderDatatable($request);
        }
        return response()->json('Oops, Somethin\' Just Broke :(');
    }

    function createQuotation(Request $request) : JsonResponse{
        if ($request->query('boq_id')) {
            return $this->quotationService->createQuotation($request);
        } 
        return response()->json('Oops, Somethin\' Just Broke :(');
    }

    function updateQuotation(Request $request) : JsonResponse{
        if ($request->query('quotation_id')) {
            return $this->quotationService->updateQuotation($request);
        } 
        return response()->json('Oops, Somethin\' Just Broke :(');
    }

    function saveAndStoreQuotation(Request $request) : JsonResponse {
        if ($request->ajax()) {
            return $this->quotationService->saveAndStoreQuotation($request);
        }
        return response()->json('Oops, Somethin\' Just Broke :(');
    }

    function getInternetBundling(Request $request) : JsonResponse {
        if ($request->ajax()) {
            return $this->quotationService->getInternetBundling($request);
        }
        return response()->json('Oops, Somethin\' Just Broke :(');
    }

    function updateInternetBundling(Request $request) : JsonResponse {
        // if ($request->ajax()) {
            return $this->quotationService->updateInternetBundling($request);
        // }
        // return response()->json('Oops, Somethin\' Just Broke :(');
    }
}
