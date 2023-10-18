<?php

namespace App\Http\Controllers\ProjectManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectManagement\WorkOrderApprovalRequest;
use App\Http\Requests\ProjectManagement\WorkOrderRequest;
use App\Models\Customer\Customer;
use App\Models\Opportunity\BoQ\ItemableBillOfQuantity;
use App\Models\ProjectManagement\WorkList;
use App\Services\ProjectManagement\WorkOrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class ProjectManagementController extends Controller
{
    protected $workOrderService;

    public function __construct(WorkOrderService $workOrderService) {
        $this->workOrderService = $workOrderService;
    }

    public function index()
    {
        return view('cmt-promag.index');
    }

    function getWorkListTable() : JsonResponse {
        $query = WorkList::with('users');

        return DataTables::of($query)
            ->addColumn('assigned', function($q) {
                $users = $q->users;
                $result = '<div></div>';

                return $result;
            })
            ->addColumn('action', function($q) {
                $result = '<div></div>';

                return $result;
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'progress', 'assigned'])
            ->make(true);
    }

    public function create()
    {
        $dataBOQ = ItemableBillOfQuantity::where('is_done', 1)->with("prospect")->get();
        return view('cmt-promag.create', compact("dataBOQ"));
    }

    public function store (Request $request) : JsonResponse {
        try {
            WorkList::create([
                "itemable_bill_of_quantity_id" => $request->itemable_bill_of_quantities_id,
                "no_project" => $request->no_project,
                "work_name" => $request->work_name,
                "work_desc" => $request->work_desc,
                "work_location" => $request->work_location,
                "no_po_customer" => $request->no_po_customer,
                "lat" => $request->lat,
                "lang" => $request->lang,
                "status" => "PR",
                "last_progress_category" => "BOQ",
                "start_date" => date("Y-m-d"),
            ]);

            return response()->json([
                "status" => "Yeay Berhasil!! 💼"
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json("Oopss, ada yang salah nih!", 500);
        }
    }

    public function detail(Request $request)
    {
        return view('cmt-promag.pages.overview');
    }

    public function files(Request $request)
    {
        return view('cmt-promag.pages.files');
    }

    public function taskLists(Request $request)
    {
        return view('cmt-promag.pages.task-lists');
    }

    function createWorkOrderSurvey(WorkOrderRequest $request) : JsonResponse {
        try {
            $result = $this->workOrderService->storeWorkOrderSurvey($request);

            return response()->json([
                "status" => "Yeay Berhasil!! 💼"
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json("Oopss, ada yang salah nih!", 500);
        }
    }

    function getDataTableWorkOrder(Request $request) : JsonResponse {
        return $this->workOrderService->renderDatatable($request);
    }

    function getDataTableWorkOrderSurvey(Request $request) : JsonResponse {
        return $this->workOrderService->renderDatatableSurveyWO($request);
    }

    function getWorkOrderById(Request $request, int $id) : JsonResponse {
        if ($request->ajax()) {
            return response()->json($this->workOrderService->getWorkOrderById($request, $id)->first(), 200);
        }
        return response()->json('Oops, Somethin\' Just Broke :(', 403);
    }

    function approveWorkOrder(WorkOrderApprovalRequest $request) : JsonResponse {
        try {
            $result = $this->workOrderService->updateApprove($request);

            return response()->json([
                "status" => "Yeay Berhasil!! 💼"
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json("Oopss, ada yang salah nih!", 500);
        }
    }
}
