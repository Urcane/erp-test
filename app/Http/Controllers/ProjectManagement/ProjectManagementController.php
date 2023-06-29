<?php

namespace App\Http\Controllers\ProjectManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectManagement\WorkOrderRequest;
use App\Models\Customer\Customer;
use App\Services\ProjectManagement\WorkOrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        return $this->workOrderService->renderDatatable();
    }
}
