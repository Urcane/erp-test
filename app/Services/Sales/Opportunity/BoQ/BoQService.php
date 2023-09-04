<?php

namespace App\Services\Sales\Opportunity\BoQ;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Customer\CustomerProspect;
use App\Services\Master\Item\ItemService;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repositories\Sales\Opportunity\BoQ\BoQRepository;

/**
 * Class BoQDraftService
 * @package App\Services
 */
class BoqService
{
    protected $BoQRepository;
    protected $itemService;
    protected $customerProspect;
    
    function __construct(BoQRepository $BoQRepository, ItemService $itemService, CustomerProspect $customerProspect) {
        $this->BoQRepository = $BoQRepository;
        $this->itemService = $itemService;
        $this->customerProspect = $customerProspect;
    }

    function renderDatatable(Request $request) : JsonResponse {
        $query = $this->BoQRepository->getAll($request); 
        return DataTables::of($query)
            ->addColumn('DT_RowChecklist', function($check) {
                return '<div class="text-center w-50px"><input name="checkbox_prospect_ids" type="checkbox" value="'.$check->prospect_id.'"></div>';
            })
            ->addColumn('action', function ($query) {
                return 
                '<button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                            <ul class="dropdown-menu">
                                <li><a href="' . url("cmt-boq/update-draft-boq?boq_id=". $query->id . "&is_draft=". $query->is_draft) .'" class="dropdown-item py-2">
                                <i class="fa-solid fa-list-check me-3"></i>Update BoQ</a></li>
                            </ul>';
            })
            ->addColumn('action_approval', function ($query) {
                return 
                '<button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                            <ul class="dropdown-menu">
                                <li><a href="' . url("cmt-boq/on-review-boq?boq_id=". $query->id) .'" class="dropdown-item py-2">
                                <i class="fa-solid fa-list-check me-3"></i>Approval BoQ</a></li>
                            </ul>';
            })
            ->addColumn('action_done', function ($query) {
                return '<button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                            <ul class="dropdown-menu">
                            <li><span class="dropdown-item py-2">No Action</span></li>
                            </ul>';
            })
            ->addColumn('action_quotation', function ($query) use($request)  {
                $actions = '<button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                            <ul class="dropdown-menu">'; 
                 // Check if 'calledFrom' key exists in $request->filters
                if (isset($request->filters['calledFrom'])) {
                    if ($request->filters['calledFrom'] == 'Internet') {
                        $actions .= '<li><a href="' . url("cmt-quotation/create-draft-quotation?boq_id=". $query->id ."&quotation=internet ") . '" class="dropdown-item py-2">
                                <i class="fa-solid fa-list-check me-3"></i>Create Quotation Internet</a></li>';
                    }
                    elseif ($request->filters['calledFrom'] == 'Perangkat') {
                        $actions .= '<li><a href="' . url("cmt-quotation/create-draft-quotation?boq_id=". $query->id ."&quotation=perangkat ") . '" class="dropdown-item py-2">
                                <i class="fa-solid fa-list-check me-3"></i>Create Quotation Perangkat</a></li>';
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
                                <li><a href="' . url("cmt-boq/get-revision-boq?boq_id=". $query->id) . '" class="dropdown-item py-2">
                                <i class="fa-solid fa-list-check me-3"></i>Recreate BoQ</a></li>
                            </ul>';
            })
            ->addColumn('next_action_pretified', function ($query) {
                return '
                <span class="fw-bold d-block">'.$query->prospect->latestCustomerProspectLog->prospect_next_action.'</span>
                <p class="text-gray-500 mb-0">'.$query->prospect->latestCustomerProspectLog->next_action_plan_date.'</p>
                ';
            })
            ->addColumn('progress_pretified', function ($query) {
                $timelineIcon = '';
                if ($query->is_draft) {
                    $timelineIcon = '<div class="timeline-icon symbol symbol-circle symbol-35px">
                                        <div class="symbol-label bg-light-info">
                                            <i class="fa-solid fa-pencil text-info"></i>    
                                        </div>
                                    </div>';
                } elseif ($query->is_final === 1 && $query->is_done === null) {
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
                                <span class="fw-bold d-block">'.$query->prospect->latestCustomerProspectLog->prospect_update.'</span>
                                <p class="text-gray-500 mb-0">Updated : '.$query->prospect->latestCustomerProspectLog->created_at.'</p>
                            </div>
                        </div>
                    </div>
                </div>
                ';
            })
            ->addIndexColumn()
            ->rawColumns(['DT_RowChecklist', 'action','action_approval', 'action_done', 'action_cancel','action_quotation', 'next_action_pretified', 'progress_pretified'])
            ->make(true);
    }

    function saveAndStoreBoq(Request $request) : JsonResponse {
        return $this->BoQRepository->saveAndStoreBoq($request);
    }

    function createRevisionBoq(Request $request) : JsonResponse {
        return $this->BoQRepository->createRevisionBoq($request);
    }

    function createDraftBoqQuery(Request $request){
        $dataProspect =  $this->BoQRepository->getProspect()->doesntHave('itemableBillOfQuantity')->get();
        $dataCompany = $this->BoQRepository->getProspect()->where('id', $request->query('prospect_id'))->first();
        $dataItem = $this->BoQRepository->getListItem();
        $dataSurvey = $this->BoQRepository->getSurvey()->where('customer_prospect_id', $request->query('prospect_id'))->get();
        return view('cmt-opportunity.boq.pages.form-create-boq', compact('dataProspect', 'dataCompany', 'dataItem', 'dataSurvey'));
    }
 
    function createDraftBoqAjax(Request $request){
        $dataCompany = $this->BoQRepository->getProspect()->where('id', $request->query('prospect_id'))->first();
        $dataSurvey = $this->BoQRepository->getSurvey()->where('customer_prospect_id', $request->query('prospect_id'))->get();
        return response()->json([
            'dataCompany' => $dataCompany,
            'dataSurvey' => $dataSurvey,
        ]);
    }

    function createDraftBoq(){
        $dataProspect = $this->BoQRepository->getProspect()->doesntHave('itemableBillOfQuantity')->get();
        $dataItem = $this->BoQRepository->getListItem();
        return view('cmt-opportunity.boq.pages.form-create-boq', compact('dataProspect', 'dataItem'));
        // return response()->json([
        //     'dataProspect' => $dataProspect,
        //     'dataItem' => $dataItem,
        // ]);
    }

    function updateDraftBoq(Request $request){
        $updateDraftBoqData = $this->BoQRepository->updateDraftBoq($request);
        if ($request->query('is_draft',1)) {
            return view('cmt-opportunity.boq.pages.form-update-boq', compact('updateDraftBoqData'));
        }
        return view('cmt-opportunity.boq.pages.form-commercial-boq', compact('updateDraftBoqData'));
    }

    function getApprovalBoq(Request $request){
        $updateDraftBoqData = $this->BoQRepository->updateDraftBoq($request);
        return view('cmt-opportunity.boq.pages.form-revision-boq', compact('updateDraftBoqData'));
    }
    
    function onReviewBoq(Request $request){
        $updateDraftBoqData = $this->BoQRepository->onReviewBoq($request); 
            return view('cmt-opportunity.boq.pages.on-review-boq', compact('updateDraftBoqData')); 
    }

    function storeApprovalBoq(Request $request) : JsonResponse {
        return $this->BoQRepository->storeApprovalBoq($request);
    }

}