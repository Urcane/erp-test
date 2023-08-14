<?php

namespace App\Services\Sales\Opportunity\BoQ;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Opportunity\BoQ\Items;
use App\Models\Customer\CustomerProspect;
use App\Services\Master\Item\ItemService;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repositories\Sales\Opportunity\BoQ\BoQRepository;
use Nette\Utils\Json;

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
                                <li><a href="' . url("cmt-boq/form-boq/" . $query->prospect_id) . '" class="dropdown-item py-2">
                                <i class="fa-solid fa-list-check me-3"></i>Edit</a></li>
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
            ->rawColumns(['DT_RowChecklist', 'action', 'next_action_pretified', 'progress_pretified'])
            ->make(true);
    }

    function getFormWithoutID()  {
        $dataFormWithId = $this->BoQRepository->getDataWithoutId()->get();
        return $dataFormWithId;
    }

    function getFormWithID($id)      {
        $dataFormWithId = $this->BoQRepository->getDataWithId($id)->where('id', $id)->first();
        return $dataFormWithId;
    }

    function saveItemsBoQ(Request $request) : JsonResponse{
        $saveBoQ = $this->BoQRepository->saveItemsBoQ($request);
        return $saveBoQ;
    }
}

