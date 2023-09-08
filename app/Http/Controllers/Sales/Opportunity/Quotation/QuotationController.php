<?php

namespace App\Http\Controllers\Sales\Opportunity\Quotation;

use Id;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\Sales\Opportunity\Quotation\QuotationService;

class QuotationController
{
    protected $quotationService;

    function __construct(QuotationService $quotationService) {
        $this->quotationService = $quotationService;
    }

    function index() { 
        return view('cmt-opportunity.quotation.pages.quotation-internet');      
    }

    function perangkat() { 
        return view('cmt-opportunity.quotation.pages.quotation-perangkat');      
    }

    function getDatatable(Request $request) : JsonResponse  {
        if ($request->ajax()) {
            return $this->quotationService->renderDatatable($request);
        }
        return response()->json('Oops, Somethin\' Just Broke :(');
    }

    function createQuotation(Request $request) {
        if ($request->query('boq_id')) {
            return $this->quotationService->createQuotation($request);
        } 
        return response()->json('Oops, Somethin\' Just Broke :(');
    }

    function updateQuotation(Request $request){
        if ($request->query('quotation_id')) {
            return $this->quotationService->updateQuotation($request);
        } 
        return response()->json('Oops, Somethin\' Just Broke :(');
    }

    function reviewDoneQuotation(Request $request){
        if ($request->query('quotation_id')) {
            return $this->quotationService->reviewDoneQuotation($request);
        } 
        return response()->json('Oops, Somethin\' Just Broke :(');
    }

    function saveAndStoreQuotation(Request $request) : JsonResponse {
        if ($request->ajax()) {
            return $this->quotationService->saveAndStoreQuotation($request);
        }
        return response()->json('Oops, Somethin\' Just Broke :(');
    }

    function storePurchaseOrder(Request $request) {
        if ($request->ajax()) {
            return $this->quotationService->storePurchaseOrder($request);
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
        if ($request->ajax()) {
            return $this->quotationService->updateInternetBundling($request);
        }
        return response()->json('Oops, Somethin\' Just Broke :(');
    }

    function exportQuotationResult($isQuotation, $id) {
        return $this->quotationService->exportQuotationResult($isQuotation,$id);
    }

    function cancelQuotation(Request $request) : JsonResponse {
        if ($request->ajax()) {
            return $this->quotationService->cancelQuotation($request);
        }
        return response()->json('Oops, Somethin\' Just Broke :(');
    }
}
