<?php

namespace App\Http\Controllers\Request;

use App\Exceptions\AuthorizationError;
use App\Exceptions\InvariantError;
use App\Exceptions\NotFoundError;
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

    public function cancelRequest(Request $request)
    {
        try {
            $timeoffRequest = UserLeaveRequest::whereId($request->id)->first();

            if (!$timeoffRequest) {
                throw new NotFoundError("Request Tidak ditemukan");
            }

            if ($timeoffRequest->user_id != Auth::user()->id) {
                throw new AuthorizationError("Anda tidak berhak melakukan ini");
            }

            if ($timeoffRequest->status != $this->constants->approve_status[0]) {
                throw new InvariantError("Tidak bisa melakukan cancel pada request");
            }

            $timeoffRequest->update([
                "status" => $this->constants->approve_status[3]
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil cancel request attendance"
            ],);
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
                ->addColumn('action', function ($query) {
                    $constants = $this->constants;

                    $fileName = $query->file;
                    $fileLink = asset("/storage/request/timeoff/$fileName");
                    return view('profile.part-profile.time-management-part.timeoff.menu', compact([
                        'query', 'constants', 'fileName', 'fileLink'
                    ]));
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
