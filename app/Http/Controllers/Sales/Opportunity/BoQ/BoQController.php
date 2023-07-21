<?php

namespace App\Http\Controllers\Sales\Opportunity\BoQ;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Customer\CustomerProspect;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Http\Requests\Opportunity\Survey\SurveyResultRequest;
use App\Services\Sales\Opportunity\Survey\SurveyResultService;
use App\Services\Sales\Opportunity\BoQ\BoQDraftService;

class BoQController extends Controller
{

    protected $surveyResultService;
    protected $BoqDraftService;

    public function __construct(
        SurveyResultService $surveyResultService,
        BoqDraftService $BoqDraftService
    ) {
        $this->surveyResultService = $surveyResultService;
        $this->BoqDraftService = $BoqDraftService;
    }

    function index()
    {
        return view('cmt-opportunity.boq.index');
    }

    function formBoQ()
    {
        return view('cmt-opportunity.boq.pages.form-boq');
    }

    function getTableProspectDone(Request $request) : JsonResponse {
        if ($request->ajax()) {
            $query = CustomerProspect::with([
                'customer.customerContact', 
                'customer.userFollowUp', 
                'latestCustomerProspectLog'
            ])->whereHas('customerProspectLogs', function ($logs) {
                $logs->where('status', 2);
            });

            return DataTables::of($query->get())
            ->addColumn('DT_RowChecklist', function($check) {
                return '<div class="text-center w-50px"><input name="checkbox_prospect_ids" type="checkbox" value="'.$check->prospect_id.'"></div>';
            })
            ->addColumn('next_action_pretified', function ($query) {
                return '
                <span class="fw-bold d-block">'.$query->latestCustomerProspectLog->prospect_next_action.'</span>
                <p class="text-gray-500 mb-0">'.$query->latestCustomerProspectLog->next_action_plan_date.'</p>
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
                                <span class="fw-bold d-block">'.$query->latestCustomerProspectLog->prospect_update.'</span>
                                <p class="text-gray-500 mb-0">Updated : '.$query->latestCustomerProspectLog->created_at.'</p>
                            </div>
                        </div>
                    </div>
                </div>
                ';
            })
            ->addColumn('action', function ($query) {
                return '     
                <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <ul class="dropdown-menu">
                    <li><a href="{route("com.boq.form-boq")}}" class="dropdown-item py-2 btn_request_survey" data-bs-toggle="modal" data-id="'.$query->id.'"><i class="fa-solid fa-list-check me-3"></i>Create BoQ</a></li>
                </ul>
                ';
            })
            ->addIndexColumn()
            ->rawColumns(['DT_RowChecklist', 'action', 'next_action_pretified', 'progress_pretified'])
            ->make(true);
        }
    }

    function getDatatableSurveyResult(Request $request) : JsonResponse {
        if ($request->ajax()) {
            return $this->surveyResultService->renderDatatable($request);
        }
        return response()->json('Oops, Somethin\' Just Broke :(');
    }

    function getDatatableDraft(Request $request) : JsonResponse {
        // if ($request->ajax()) {
            return $this->BoqDraftService->renderDatatable($request);
        // }
        // return response()->json('Oops, Somethin\' Just Broke :(');
    }
}
