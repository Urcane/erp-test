<?php

namespace App\Services\Sales\Opportunity\Quotation;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\Master\FileService;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Inventory\InventoryUnitMaster;
use App\Services\Master\Inventory\InventoryService;
use App\Repositories\Sales\Opportunity\Quotation\QuotationRepository;

class QuotationService 
{
    protected $quotationRepository;
    protected $fileService;
    protected $inventoryService;

    function __construct(QuotationRepository $quotationRepository, FileService $fileService, InventoryService $inventoryService) {
        $this->quotationRepository = $quotationRepository;
        $this->fileService = $fileService;
        $this->inventoryService = $inventoryService;
    }

    function renderDatatable(Request $request) : JsonResponse {
        $query = $this->quotationRepository->getAll($request)->get(); 
        return DataTables::of($query) 
            ->addColumn('DT_RowChecklist', function($check) {
                return '<div class="text-center w-50px"><input name="checkbox_prospect_ids" type="checkbox" value="'.$check->prospect_id.'"></div>';
            })
            ->addColumn('action_update', function ($query) use($request) {
                $actions = '<button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <ul class="dropdown-menu">'; 
                    if (isset($request->filters['calledFrom'])) {
                        if ($request->filters['calledFrom'] == 'Internet') {
                            $actions .= '<li><a href="' . url("cmt-quotation/update-quotation?quotation_id=". $query->id ."&quotation=internet ") . '" class="dropdown-item py-2">
                                    <i class="fa-solid fa-list-check me-3"></i>Update Quotation Internet</a></li>';
                        }
                        elseif ($request->filters['calledFrom'] == 'Perangkat') {
                            $actions .= '<li><a href="' . url("cmt-quotation/update-quotation?quotation_id=". $query->id ."&quotation=perangkat ") . '" class="dropdown-item py-2">
                                    <i class="fa-solid fa-list-check me-3"></i>Update Quotation Perangkat</a></li>';
                        }
                    } else {                    
                    $actions .= '<li><span class="dropdown-item py-2">No Action</span></li>';
                    }

                    $actions .= '</ul>';
                    return $actions; 
            })
            ->addColumn('action_done', function ($query) use($request) {
                $actions = '<button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <ul class="dropdown-menu">'; 
                    if (isset($request->filters['calledFrom'])) {
                        if ($request->filters['calledFrom'] == 'Internet') {
                            $actions .= '<li><a href="' . url("cmt-quotation/review-done-quotation?quotation_id=". $query->id ."&quotation=internet ") . '" class="dropdown-item py-2">
                                    <i class="fa-solid fa-list-check me-3"></i>Done Quotation Internet</a></li>';
                        }
                        elseif ($request->filters['calledFrom'] == 'Perangkat') {
                            $actions .= '<li><a href="' . url("cmt-quotation/review-done-quotation?quotation_id=". $query->id ."&quotation=perangkat ") . '" class="dropdown-item py-2">
                                    <i class="fa-solid fa-list-check me-3"></i>Done Quotation Perangkat</a></li>';
                        }
                    } else {                    
                    $actions .= '<li><span class="dropdown-item py-2">No Action</span></li>';
                    }

                    $actions .= '</ul>';
                    return $actions; 
            }) 
            ->addColumn('action_cancel', function ($query) {
                return 
                '<button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                            <ul class="dropdown-menu">
                                <li><a href="' . url("cmt-boq/get-revision-quotation?quotation_id=". $query->id) . '" class="dropdown-item py-2">
                                <i class="fa-solid fa-list-check me-3"></i>Recreate Quotation</a></li>
                            </ul>';
            })
            ->addColumn('status', function ($query){
                if($query->is_done == 1){
                    $badge = 'success';
                    $icon = 'fa-pen';
                    $text = 'Done'; 
                } elseif($query->is_done == 0 ){
                    $badge = 'danger';
                    $icon = 'fa-times';
                    $text = 'Batal'; 
                }
                    $badge = 'warning';
                    $icon = 'fa-building-circle-check';
                    $text = 'On Progress'; 

                return '<span class="badge px-3 py-2 badge-light-'.$badge.'"><i class="fa-solid text-'.$badge.' '.$icon.' me-3"></i>'.$text.'</span>';
            })
            ->addColumn('progress_pretified', function ($query) {
                $timelineIcon = '';
                 if ($query->is_done === null) {
                    $timelineIcon = '<div class="timeline-icon symbol symbol-circle symbol-35px">
                                        <div class="symbol-label bg-light-info">
                                            <i class="fa-solid fa-check text-info"></i>    
                                        </div>
                                    </div>';
                } elseif ($query->is_done === 1) {
                    $timelineIcon = '<div class="timeline-icon symbol symbol-circle symbol-35px">
                                        <div class="symbol-label bg-light-success">
                                            <i class="fa-solid fa-check text-success"></i>    
                                        </div>
                                    </div>';
                } elseif ($query->is_done === 0) {
                    $timelineIcon = '<div class="timeline-icon symbol symbol-circle symbol-35px">
                                        <div class="symbol-label bg-light-danger">
                                            <i class="fa-solid fa-times text-danger"></i>    
                                        </div>
                                    </div>';
                } else {
                    $timelineIcon = '<div class="timeline-icon symbol symbol-circle symbol-35px">
                    <div class="symbol-label bg-light-info">
                        <i class="fa-solid fa-pencil text-info"></i>    
                    </div>
                </div>';
                }
                return '
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-line w-35px"></div>
                        '.$timelineIcon.'
                        <div class="timeline-content">
                            <div class="pe-5">
                                <span class="fw-bold d-block">'.$query->remark.'</span>
                                <p class="text-gray-500 mb-0">Updated : '.$query->created_at.'</p>
                            </div>
                        </div>
                    </div>
                </div>
                ';
            })
            ->addIndexColumn()
            ->rawColumns(['DT_RowChecklist','action_update', 'status', 'action_done', 'action_cancel', 'progress_pretified'])
            ->make(true);
    }

    function createQuotation(Request $request)  {
        $dataBoq = $this->quotationRepository->createQuotation($request);  
        $dataUnit = InventoryUnitMaster::get();
        $quotation = $request->query('quotation');
        if ($quotation === 'internet') { 
            return view('cmt-opportunity.quotation.pages.create-internet-quotation', compact('dataBoq', 'dataUnit'));
        } elseif ($quotation === 'perangkat') { 
            return view('cmt-opportunity.quotation.pages.create-perangkat-quotation', compact('dataBoq', 'dataUnit'));
        } 
    }

    function updateQuotation(Request $request)  {
        $dataQuotation = $this->quotationRepository->updateQuotation($request);
        $quotation = $request->query('quotation');
        //page update belum ada
        if ($quotation === 'internet') { 
            return view('cmt-opportunity.quotation.pages.update-internet-quotation', compact('dataQuotation'));
        } elseif ($quotation === 'perangkat') { 
            return view('cmt-opportunity.quotation.pages.update-perangkat-quotation', compact('dataQuotation'));
        } 
    }

    function reviewDoneQuotation(Request $request) {
        $dataQuotation = $this->quotationRepository->updateQuotation($request);
        $quotation = $request->query('quotation');
        if ($quotation === 'internet') { 
            return view('cmt-opportunity.quotation.pages.done-internet-quotation', compact('dataQuotation'));
        } elseif ($quotation === 'perangkat') { 
            return view('cmt-opportunity.quotation.pages.done-perangkat-quotation', compact('dataQuotation'));
        } 
    }

    function saveAndStoreQuotation(Request $request) : JsonResponse {
        $data = $this->quotationRepository->saveAndStoreQuotation($request);
        return response()->json(['message' => 'Quotation berhasil disimpan.', 'data' => $data], 200);
    }

    function storePurchaseOrder(Request $request) {
        $dataQuotation = $this->quotationRepository->storePurchaseOrder($request);
        // dd($request->file('file_purchase_order_internet'));
        if (null !== ($request->file('file_purchase_order_internet'))) {
            $file = $this->fileService->storeFile($dataQuotation, [
                'file' => $request->file('file_purchase_order_internet'),
                'filePath' => 'purchase-order-customer',
                'fileName' => 'File Purchase Order Customer',
                'additional' => 'quotation/purchase-order'
            ]);
            $dataQuotation->is_done = 1;
        }

        $dataQuotation->save();
        return response()->json(['message' => 'Quotation berhasil disimpan.'], 200);
    }

    function getInternetBundling() : JsonResponse {
        return $this->inventoryService->getInternetBundling();
    }

    function updateInternetBundling(Request $request) : JsonResponse {
        return $this->inventoryService->updateInternetBundling($request);
    }

    function exportQuotationResult($isQuotation,$id){
        return $this->quotationRepository->exportQuotationResult($isQuotation, $id);
    }

    function cancelQuotation(Request $request) : JsonResponse {
        return $this->quotationRepository->cancelQuotation($request);
    }
}