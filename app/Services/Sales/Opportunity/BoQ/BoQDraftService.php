<?php

namespace App\Services\Sales\Opportunity\BoQ;

use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repositories\Sales\Opportunity\BoQ\BoQDraftRepository;

/**
 * Class BoQDraftService
 * @package App\Services
 */
class BoQDraftService
{
    protected $BoQDraftRepository;
    
    function __construct(BoQDraftRepository $BoQDraftRepository) {
        $this->BoQDraftRepository = $BoQDraftRepository;
    }

    function renderDatatable(Request $request) : JsonResponse {
        $query = $this->BoQDraftRepository->getAll($request);

        return DataTables::of($query)
            ->addColumn('DT_RowChecklist', function($check) {
                return '<div class="text-center w-50px"><input name="checkbox_prospect_ids" type="checkbox" value="'.$check->prospect_id.'"></div>';
            })
            ->addColumn('action', function ($query) {
                $additionalMenu = "";

                if ($query->type_of_survey_id == 2) {
                    $additionalMenu .= "<li><a href=\"#kt_modal_create_wo_survey\" class=\"dropdown-item py-2 btn_create_wo_survey\" data-bs-toggle=\"modal\" data-id=\"$query->id\"><i class=\"fa-solid fa-list-check me-3\"></i>Terbit WO Survey</a></li>";
                }

                return "
                <button type=\"button\" class=\"btn btn-secondary btn-icon btn-sm\" data-kt-menu-placement=\"bottom-end\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\"><i class=\"fa-solid fa-ellipsis-vertical\"></i></button>
                <ul class=\"dropdown-menu\">
                    $additionalMenu
                    <li><a href=\"#kt_modal_request_survey\" class=\"dropdown-item py-2 btn_request_survey\" data-bs-toggle=\"modal\" data-id=\"$query->id\"><i class=\"fa-solid fa-list-check me-3\"></i>Edit</a></li>
                </ul>
                ";
            })
            ->addColumn('next_action_pretified', function ($query) {
                return '
                <span class="fw-bold d-block">'.$query->prospect->latestCustomerProspectLog->prospect_next_action.'</span>
                <p class="text-gray-500 mb-0">'.$query->prospect->latestCustomerProspectLog->next_action_plan_date.'</p>
                ';
            })
            ->addColumn('progress_pretified', function ($query) {
                return '
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-line w-35px"></div>
                        <div class="timeline-icon symbol symbol-circle symbol-35px">
                            <div class="symbol-label bg-light-success">
                                <i class="fa-solid fa-check text-success"></i>    
                            </div>
                        </div>
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

}
