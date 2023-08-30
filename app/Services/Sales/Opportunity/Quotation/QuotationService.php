<?php

namespace App\Services\Sales\Opportunity\Quotation;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\Master\FileService;
use Yajra\DataTables\Facades\DataTables;
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
        $query = $this->quotationRepository->getAll($request);

        return DataTables::of($query)
            ->addColumn('DT_RowChecklist', function($check) {
                return '<div class="text-center w-50px"><input name="checkbox_prospect_ids" type="checkbox" value="'.$check->prospect_id.'"></div>';
            })
            ->addColumn('action', function ($query) {
                return 
                '<button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                            <ul class="dropdown-menu">
                                <li><a href="' . url("cmt-boq/update-quotation?quotation_id=". $query->id ) .'" class="dropdown-item py-2">
                                <i class="fa-solid fa-list-check me-3"></i>Update Quotation</a></li>
                            </ul>';
            })
            ->addColumn('action_done', function ($query) {
                return 
                '<button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                            <ul class="dropdown-menu">
                            <li><span class="dropdown-item py-2">No Action</span></li>
                            </ul>';
            })
            ->addColumn('action_cancel', function ($query) {
                return 
                '<button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                            <ul class="dropdown-menu">
                                <li><a href="' . url("cmt-boq/get-revision-quotation?quotation_id=". $query->id) . '" class="dropdown-item py-2">
                                <i class="fa-solid fa-list-check me-3"></i>Recreate Quotation</a></li>
                            </ul>';
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
            ->rawColumns(['DT_RowChecklist', 'action', 'action_done', 'action_cancel', 'progress_pretified'])
            ->make(true);
    }

    function createQuotation(Request $request)  {
        $dataBoq = $this->quotationRepository->createQuotation($request);
        return view('', compact('dataBoq'));
        // return response()->json($dataBoq);
    }

    function updateQuotation(Request $request)  {
        $dataQuotation = $this->quotationRepository->updateQuotation($request);
        return view('', compact('dataQuotation'));
        // return response()->json($dataQuotation);
    }

    function saveAndStoreQuotation(Request $request) : JsonResponse {
        $dataQuotation = $this->quotationRepository->saveAndStoreQuotation($request);
        
        if (null !== ($request->file('quotation.customer_purchase_order'))) {
            $file = $this->fileService->storeFile($dataQuotation, [
                'file' => $request->file('quotation.customer_purchase_order'),
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
}