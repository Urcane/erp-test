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

    public function create()
    {
        $dataBOQ = ItemableBillOfQuantity::where('is_done', 1)->with("prospect")->get();
        return view('cmt-promag.create', compact("dataBOQ"));
    }

    public function datatable(Request $request)
    {
        $query = WorkList::with(["itemable_bill_of_quantity", "users"]);

        return DataTables::of($query)
            ->addColumn('action', function ($action) {
                $edit = '
                <li>
                    <div class="btn-edit" onclick="fillInput(\'' . $action->id . '\', \'' . $action->user_file_category_id . '\', \'' . $action->description . '\')">
                        <a href="" class="dropdown-item py-2"><i class="fa-solid fa-pen me-3"></i>Edit</a>
                    </div>
                </li>

                ';
                $delete = '<li><button onclick="deleteUserFile(\'' . $action->id . '\')" class="dropdown-item py-2"><i class="fa-solid fa-trash me-3"></i>Delete</button></li>';
                return '
                <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <ul class="dropdown-menu">
                '.$edit.'
                '.$delete.'
                </ul>
                ';
            })
            ->addColumn('assigned', function ($data) {
                return $data->users->count();
            })
            ->addIndexColumn()
            ->rawColumns(['action','DT_RowChecklist'])
            ->make(true);
    }

    public function store (Request $request) : JsonResponse {
        try {
            $request->validate([
                "itemable_bill_of_quantities_id" => "required",
                "work_name" => "required",
                "no_project" => "required",
                "work_desc" => "required",
                "work_location" => "required",
                "no_po_customer" => "required",
                "lat" => "required",
                "lang" => "required",
            ]);

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

            return redirect(route("com.promag.index"));
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
        dd("Asdfsf");
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
