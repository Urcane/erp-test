<?php

namespace App\Http\Controllers\Request;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Yajra\DataTables\DataTables;

use App\Exceptions\InvariantError;
use App\Models\Attendance\UserShiftRequest;
use Carbon\Carbon;

class ShiftController extends RequestController
{
    public function makeRequest(Request $request)
    {
        try {
            $request->validate([
                "date" => "required|date",
                "working_shift_id" => "required",
                "notes" => "nullable|string"
            ]);

            $userShiftId = Auth::user()->userEmployment->workingScheduleShift->workingShift->id;

            if ($userShiftId == $request->working_shift_id) {
                throw new InvariantError("Tidak dapat melakukan request shift terhadap shift yang sama");
            }

            UserShiftRequest::create([
                "user_id" => Auth::user()->id,
                "working_shift_id" => $request->working_shift_id,
                "date" => $request->date,
                "notes" => $request->notes,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil melakukan request shift"
            ], 201);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function showRequestTableById(Request $request)
    {
        if (request()->ajax()) {
            $shiftRequests = UserShiftRequest::where('user_id', $request->user_id)
                ->orderBy('created_at', 'desc')
                ->with(['user.userEmployment', 'workingShift', 'approvalLine']);

            return DataTables::of($shiftRequests)
                ->addColumn('action', function ($action) {
                    $menu = '<li><a href="' . route('hc.emp.profile', ['id' => $action->id]) . '" class="dropdown-item py-2"><i class="fa-solid fa-id-badge me-3"></i>Profile</a></li>';
                    return '
                    <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                    <ul class="dropdown-menu">
                    ' . $menu . '
                    </ul>
                    ';
                })
                ->addColumn('approval_line', function ($shiftRequest) {
                    if ($shiftRequest->status != $this->constants->approve_status[0]) {
                        return $shiftRequest->approvalLine->name ?? "-";
                    }

                    return $shiftRequest->user->userEmployment->approvalLine->name ?? "-";
                })
                ->addColumn('created_at', function ($shiftRequest) {
                    $date = explode(" ", explode("T", $shiftRequest->created_at)[0])[0];

                    $date = Carbon::createFromFormat('Y-m-d', $date);
                    $formattedDate = $date->format('d-m-Y');

                    return $formattedDate;
                })
                ->addColumn('date', function ($shiftRequest) {
                    $date = Carbon::createFromFormat('Y-m-d', $shiftRequest->date);
                    $formattedDate = $date->format('d-m-Y');

                    return $formattedDate;
                })
                ->addColumn('shift', function ($shiftRequest) {
                    return $shiftRequest->workingShift->name;
                })
                ->addColumn('working_start', function ($shiftRequest) {
                    return $shiftRequest->workingShift->working_start;
                })
                ->addColumn('working_end', function ($shiftRequest) {
                    return $shiftRequest->workingShift->working_end;
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'DT_RowChecklist'])
                ->make(true);
        }
    }
}
