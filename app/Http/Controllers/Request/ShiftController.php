<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rule;

use App\Utils\ErrorHandler;
use App\Constants;
use App\Exceptions\AuthorizationError;
use App\Exceptions\InvariantError;
use App\Exceptions\NotFoundError;
use App\Models\Attendance\UserAttendanceRequest;
use App\Models\Attendance\UserAttendance;
use App\Models\Attendance\UserShiftRequest;
use App\Models\Employee\UserEmployment;

class ShiftController extends Controller
{
    private $errorHandler;
    private $constants;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
        $this->constants = new Constants();
    }

    private function _updateAttendance($userId, $date, $workingStart, $workingEnd)
    {
        UserAttendance::where('user_id', $userId)->where('date', $date)->first()->update([
            "working_start" => $workingStart,
            "working_end" => $workingEnd
        ]);
    }

    public function makeRequest(Request $request)
    {
        try {
            $request->validate([
                "date" => "required|date",
                "working_shift_id" => "required",
                "notes" => "nullable|string"
            ]);

            $userShiftId = UserEmployment::where('user_id', Auth::user()->id)->first()->workingScheduleShift->workingShift->id;

            if ($userShiftId == $request->working_shift_id) {
                throw new InvariantError("Tidak dapat melakukan request shift terhadap shift yang sama");
            }

            UserShiftRequest::create([
                "user_id" => Auth::user()->id,
                "approval_line" => Auth::user()->approve_line,
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

    public function updateRequestStatus(Request $request)
    {
        try {
            $request->validate([
                "shift_request_id" => "required",
                "status" => ["required", Rule::in($this->constants->approve_status)],
            ]);

            $shiftRequest = UserShiftRequest::whereId($request->shift_request_id)->first();

            if (!$shiftRequest) {
                throw new NotFoundError("Shift Request tidak ditemukan");
            }

            if (!$shiftRequest->approval_line) {
                if ($request->status == $this->constants->approve_status[1]) {
                    $this->_updateAttendance(
                        $shiftRequest->user_id,
                        $shiftRequest->date,
                        $shiftRequest->working_start,
                        $shiftRequest->working_end
                    );
                }

                $shiftRequest->update([
                    "status" => $request->status,
                ]);

                return response()->json([
                    "status" => "success",
                    "message" => "berhasil melakukan update status request shift"
                ]);
            }

            if ($shiftRequest->approval_line != Auth::user()->id) {
                throw new AuthorizationError("Anda tidak berhak melakukan update status");
            }

            if ($shiftRequest->status == $this->constants->approve_status[1]) {
                throw new InvariantError("Tidak dapat melakukan update status, Request sudah di approve");
            }

            if ($shiftRequest->status == $this->constants->approve_status[2]) {
                throw new InvariantError("Tidak dapat melakukan update status, Request sudah di reject");
            }

            if ($request->status == $this->constants->approve_status[1]) {
                $this->_updateAttendance(
                    $shiftRequest->user_id,
                    $shiftRequest->date,
                    $shiftRequest->working_start,
                    $shiftRequest->working_end
                );
            }

            $shiftRequest->update([
                "status" => $request->status,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "berhasil melakukan update status request shift"
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function showRequestTableById(Request $request)
    {
        if (request()->ajax()) {
            $shiftRequests = UserShiftRequest::where('user_id', $request->user_id)->with('workingShift')->orderBy('created_at', 'desc');

            return DataTables::of($shiftRequests)
                ->addColumn('action', function ($action) {
                    $menu = '<li><a href="'.route('hc.emp.profile',['id'=>$action->id]).'" class="dropdown-item py-2"><i class="fa-solid fa-id-badge me-3"></i>Profile</a></li>';
                    return '
                    <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                    <ul class="dropdown-menu">
                    '.$menu.'
                    </ul>
                    ';
                })
                ->addColumn('approval_line', function ($shiftRequests) {
                    return $shiftRequests->approvalLine->name ?? "-";
                })
                ->addColumn('shift', function ($shiftRequests) {
                    return $shiftRequests->workingShift->name;
                })
                ->addColumn('working_start', function ($shiftRequests) {
                    return $shiftRequests->workingShift->working_start;
                })
                ->addColumn('working_end', function ($shiftRequests) {
                    return $shiftRequests->workingShift->working_end;
                })
                ->addIndexColumn()
                ->rawColumns(['action','DT_RowChecklist'])
                ->make(true);
        }
    }
}
