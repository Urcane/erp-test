<?php

namespace App\Http\Controllers\Request;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Yajra\DataTables\DataTables;

use App\Models\Attendance\GlobalDayOff;
use App\Models\Attendance\UserLeaveRequest;
use Carbon\Carbon;

class TimeOffController extends RequestController
{
    public function makeRequest(Request $request)
    {
        try {
            $request->validate([
                "start_date" => "required|date",
                "end_date" => "required|date|after:start_date",
                "leave_request_category_id" => "required",
                "file" => "required",
                "notes" => "nullable|string"
            ]);

            Carbon::setLocale($this->constants->locale);

            $startDate = Carbon::parse($request->start_date);
            $endDate = Carbon::parse($request->end_date);

            $taken = 0;
            $workingDayOff = Auth::user()->userEmployment->workingScheduleShift->workingSchedule->dayOffs->pluck('name')->toArray();
            $holidayDates = GlobalDayOff::whereBetween('date', [$startDate, $endDate])->pluck('date')->toArray();

            while ($startDate <= $endDate) {
                $currentDate = $startDate->copy();
                $dayName = $currentDate->translatedFormat('l');

                if (!in_array($currentDate->toDateString(), $holidayDates) && !in_array($dayName, $workingDayOff)) {
                    $taken += 1;
                }

                $startDate->addDay();
            }

            if ($request->file) {
                $file = $request->file('file');
                $filename = time() . $file->getClientOriginalName();
                $file->storeAs('request/timeoff/', $filename, 'public');
            }

            UserLeaveRequest::create([
                "user_id" => Auth::user()->id,
                "leave_request_category_id" => $request->leave_request_category_id,
                "file" => $filename ?? null,
                "start_date" => $request->start_date,
                "end_date" => $request->end_date,
                "taken" => $taken,
                "notes" => $request->notes,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil melakukan request time off"
            ], 201);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function showRequestTableById(Request $request)
    {
        if (request()->ajax()) {
            $leaveRequest = UserLeaveRequest::where('user_id', $request->user_id)
                ->orderBy('created_at', 'desc')
                ->with(['user.userEmployment', 'approvalLine', 'leaveRequestCategory']);

            return DataTables::of($leaveRequest)
                ->addColumn('action', function ($action) {
                    $menu = '<li><a href="' . route('hc.emp.profile', ['id' => $action->id]) . '" class="dropdown-item py-2"><i class="fa-solid fa-id-badge me-3"></i>Profile</a></li>';
                    return '
                    <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                    <ul class="dropdown-menu">
                    ' . $menu . '
                    </ul>
                    ';
                })
                ->addColumn('created_at', function ($leaveRequest) {
                    $date = explode(" ", explode("T", $leaveRequest->created_at)[0])[0];

                    $date = Carbon::createFromFormat('Y-m-d', $date);
                    $formattedDate = $date->format('d-m-Y');

                    return $formattedDate;
                })
                ->addColumn('approval_line', function ($leaveRequest) {
                    if ($leaveRequest->status != $this->constants->approve_status[0]) {
                        return $leaveRequest->approvalLine->name ?? "-";
                    }

                    return $leaveRequest->user->userEmployment->approvalLine->name ?? "-";
                })
                ->addColumn('taken', function ($leaveRequest) {
                    return "$leaveRequest->taken Day(s)";
                })
                ->addColumn('code', function ($leaveRequest) {
                    return $leaveRequest->leaveRequestCategory->code;
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'DT_RowChecklist'])
                ->make(true);
        }
    }
}
