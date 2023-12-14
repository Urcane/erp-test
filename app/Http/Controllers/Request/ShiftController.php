<?php

namespace App\Http\Controllers\Request;

use App\Exceptions\AuthorizationError;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Yajra\DataTables\DataTables;

use App\Exceptions\InvariantError;
use App\Exceptions\NotFoundError;
use App\Models\Attendance\UserAttendance;
use App\Models\Attendance\UserShiftRequest;
use App\Models\Employee\UserCurrentShift;
use App\Models\Employee\WorkingScheduleShift;
use App\Utils\ErrorHandler;
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

            $userCurrentShift = UserCurrentShift::where('user_id', $request->user()->id)->with("workingScheduleShift")->first();
            $workingScheduleShift = WorkingScheduleShift::where('working_schedule_id', $userCurrentShift->workingScheduleShift->working_schedule_id)->get();

            Carbon::setLocale($this->constants->locale);
            $requestDate = Carbon::parse($request->date);
            $now = Carbon::now();
            $diff = $now->diffInDays($requestDate);
            $countOfSchedule = $workingScheduleShift->count();
            $distance = $diff - (floor($diff/$countOfSchedule) * $countOfSchedule);

            $primaryScheduleShift = $workingScheduleShift->find($userCurrentShift->working_schedule_shift_id);
            for ($i=0; $i < $distance; $i++) {
                if ($requestDate > $now) {
                    $primaryScheduleShift = $workingScheduleShift->find($primaryScheduleShift->next);
                } else {
                    $primaryScheduleShift = $workingScheduleShift->filter(function ($scheduleShift) use ($primaryScheduleShift){
                        return $scheduleShift->next == $primaryScheduleShift->id;
                    })->first();
                }
            }

            $userShiftId = $primaryScheduleShift->workingShift->id;

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
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function cancelRequest(Request $request)
    {
        try {
            $shiftRequest = UserShiftRequest::whereId($request->id)->first();

            if (!$shiftRequest) {
                throw new NotFoundError("Request Tidak ditemukan");
            }

            if ($shiftRequest->user_id != Auth::user()->id) {
                throw new AuthorizationError("Anda tidak berhak melakukan ini");
            }

            if ($shiftRequest->status != $this->constants->approve_status[0]) {
                throw new InvariantError("Tidak bisa melakukan cancel pada request");
            }

            $shiftRequest->update([
                "status" => $this->constants->approve_status[3]
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil cancel request shift"
            ],);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function showRequestTableById(Request $request)
    {
        if (request()->ajax()) {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            if (!($user->id == $request->user_id|| $user->hasPermissionTo('HC:view-attendance'))) {
                abort(403);
            }

            $shiftRequests = UserShiftRequest::where('user_id', $request->user_id)
                ->orderBy('created_at', 'desc')
                ->with(['user.userEmployment', 'workingShift', 'approvalLine']);

            $userCurrentShift = UserCurrentShift::where('user_id', $request->user_id)->with("workingScheduleShift")->first();
            $workingScheduleShift = WorkingScheduleShift::where('working_schedule_id', $userCurrentShift->workingScheduleShift->working_schedule_id)->get();

            return DataTables::of($shiftRequests)
                ->addColumn('action', function ($query) use ($workingScheduleShift, $userCurrentShift) {
                    $constants = $this->constants;

                    $shiftChanged = false;
                    $shift = "-";
                    $workHour = "-";
                    $prmshift = "-";
                    $prmworkHour = "-";

                    $userAttendance = UserAttendance::where('user_id', $query->user->id)
                        ->whereDate('date', $query->date)->first();

                    if (!$userAttendance) {
                        Carbon::setLocale($this->constants->locale);
                        $requestDate = Carbon::parse($query->date);
                        $now = Carbon::now();
                        $diff = $now->diffInDays($requestDate);
                        $countOfSchedule = $workingScheduleShift->count();
                        $distance = $diff - (floor($diff/$countOfSchedule) * $countOfSchedule);

                        $primaryScheduleShift = $workingScheduleShift->find($userCurrentShift->working_schedule_shift_id);
                        for ($i=0; $i < $distance; $i++) {
                            if ($requestDate > $now) {
                                $primaryScheduleShift = $workingScheduleShift->find($primaryScheduleShift->next);
                            } else {
                                $primaryScheduleShift = $workingScheduleShift->filter(function ($scheduleShift) use ($primaryScheduleShift){
                                    return $scheduleShift->next == $primaryScheduleShift->id;
                                })->first();
                            }
                        }

                        $workingShift = $primaryScheduleShift->workingShift;

                        $shift = $workingShift->name;
                        $workHour = "{$workingShift->working_start} - {$workingShift->working_end}";
                    } else {
                        $shiftChanged = $userAttendance->shift_changed;

                        if ($shiftChanged) {
                            $prmshift = $userAttendance->primary_shift_name;
                            $prmstart = $userAttendance->primary_working_start;
                            $prmend = $userAttendance->primary_working_end;
                            $prmworkHour = "{$prmstart} - {$prmend}";
                        }

                        $shift = $userAttendance->shift_name;
                        $start = $userAttendance->working_start;
                        $end = $userAttendance->working_end;
                        $workHour = "{$start} - {$end}";
                    }
                    return view('profile.part-profile.time-management-part.shift.menu', compact([
                        'query', 'shift', 'workHour', 'shiftChanged', 'prmshift', 'prmworkHour'
                    ]));
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
