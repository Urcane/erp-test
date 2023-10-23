<?php

namespace App\Http\Controllers\ProjectManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectManagement\WorkOrderApprovalRequest;
use App\Http\Requests\ProjectManagement\WorkOrderRequest;
use App\Models\Customer\Customer;
use App\Models\Opportunity\BoQ\ItemableBillOfQuantity;
use App\Models\ProjectManagement\WorkList;
use App\Models\User;
use App\Services\ProjectManagement\WorkOrderService;
use App\Utils\ErrorHandler;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProjectManagementController extends Controller
{
    protected $workOrderService;
    protected $errorHandler;

    public function __construct(WorkOrderService $workOrderService, ErrorHandler $errorHandler) {
        $this->workOrderService = $workOrderService;
        $this->errorHandler = $errorHandler;
    }

    public function index()
    {
        return view('cmt-promag.index');
    }

    function getWorkListTable() : JsonResponse {
        $query = WorkList::with('users', 'projectStatus');

        return DataTables::of($query)
            ->addColumn('assigned', function($q) {
                $users = $q->users->slice(0,4);
                $mainpath = asset('sense');

                $listPeople = $users->map(function($user) use($mainpath) {
                    return '
                    <div class="symbol symbol-circle symbol-30px" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$user->name.'">
                        <img src="'.$mainpath.'/media/avatars/blank.png" alt="">
                    </div>
                    ';
                })->join('');

                $result = '
                <div class="symbol-group symbol-hover">
                    '.$listPeople.'
                    <div class="symbol symbol-circle symbol-30px">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_users_search" class="add-users" data-id='.$q->id.'>
                            <div class="symbol-label bg-light">
                                <span class="fs-7"><i class="fa-solid fa-user-plus"></i></span>
                            </div>
                        </a>
                    </div>
                </div>
                ';

                return $result;
            })
            ->addColumn('action', function($q) {
                $route = route('com.promag.detail', ['work_list_id' => $q->id]);

                $result = '
                <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <ul class="dropdown-menu w-150px">
                    <li><a href="'.$route.'" class="btn_edit_karyawan dropdown-item py-2" data-id="'.$q->id.'"><i class="fa-solid fa-pen me-4"></i>Edit</a></li>
                    <li><a class="dropdown-item py-2 text-success"><i class="fa-solid fa-bars-progress me-4 text-success"></i>Progress</a></li>
                    <div class="separator my-2"></div>
                    <li><a class="dropdown-item py-2"><i class="fa-solid fa-file-lines me-4"></i>Terbitkan <b class="text-warning">WO</b></a></li>
                </ul>
                ';

                return $result;
            })
            ->editColumn('progress', function($q) {
                return '
                <div class="d-flex align-items-center w-100 mw-125px">
                    <div class="progress h-6px w-100 me-2 bg-light-info">
                        <div class="progress-bar bg-info" role="progressbar" style="width: '.$q->progress.'%" aria-valuenow="'.$q->progress.'" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <span class="text-muted fs-8 fw-semibold">
                        '.round($q->progress, 0).'%
                    </span>
                </div>
                ';
            })
            ->editColumn('status', function($q) {
                switch ($q->status) {
                    case 'PR':
                        $color = 'info';
                        break;
                    case 'DN':
                        $color = 'success';
                        break;
                    case 'PD':
                        $color = 'warning';
                        break;
                    case 'FR':
                        $color = 'light';
                        break;
                    default:
                        $color = 'dark';
                        break;
                }

                return '
                    <span class="badge badge-'.$color.' badge-inline badge-pill badge-rounded"><strong>'.$q->projectStatus->name.'</strong></span>
                ';
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'progress', 'assigned', 'status'])
            ->make(true);
    }

    public function create()
    {
        $dataBOQ = ItemableBillOfQuantity::where('is_done', 1)->with("prospect")->get();
        return view('cmt-promag.create', compact("dataBOQ"));
    }

    public function store(Request $request) {
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
                "work_desc" => "required",
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
            $data = $this->errorHandler->handle($th);
            // Log::error($th);
            return response()->json($data['data'], $data['code']);
        }
    }

    public function detail($work_list_id )
    {
        return view('cmt-promag.pages.overview', compact("work_list_id"));
    }

    public function files(Request $request)
    {
        return view('cmt-promag.pages.files');
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

    function getWorklistAssiggnedUsers(WorkList $work_list_id) : JsonResponse{

        try {
            $workList = $work_list_id->load('users.department', 'users.division');

            return response()->json([
                "status" => "Yeay Berhasil!! 💼",
                "data" => $workList,
            ], 200);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);
            return response()->json($data["data"], $data['code']);
        }
    }

    function revokeWorklistAssignedUsers(WorkList $work_list_id, User $user_id) : JsonResponse{
        try {
            $data = $work_list_id->users()->detach($user_id->id);

            return response()->json([
                "status" => "Yeay Berhasil!! 💼",
                "data" => $data,
            ], 200);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);
            return response()->json($data["data"], $data['code']);
        }
    }

    function getAllUserFiltered(Request $request, WorkList $work_list_id) : JsonResponse {
        try {
            $search = $request->query('searchValue');

            $users = User::where('name', 'like', "%$search%")->with('workLists')->limit(10)->get();

            return response()->json([
                'status' => 'success',
                'users' => $users
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);
            return response()->json($data["data"], $data['code']);
        }
    }

    function assignUser(Request $request, WorkList $work_list_id) : JsonResponse {
        $request->validate([
            'users' => 'required',
            'users.*' => 'exists:users,id'
        ]);

        try {
            $workList = $work_list_id->users()->attach($request->users);

            return response()->json([
                'status' => 'success',
                'data' => $workList,
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);
            return response()->json($data["data"], $data['code']);
        }
    }
}
