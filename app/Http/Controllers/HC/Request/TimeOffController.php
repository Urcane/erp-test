<?php

namespace App\Http\Controllers\HC\Request;

use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Yajra\DataTables\Facades\DataTables;

use App\Models\Attendance\GlobalDayOff;
use App\Models\Attendance\UserAttendance;
use App\Models\Attendance\UserLeaveRequest;

use App\Exceptions\AuthorizationError;
use App\Exceptions\InvariantError;
use App\Exceptions\NotFoundError;
use App\Models\Attendance\UserLeaveHistory;

use DateTime;
use DateInterval;
use DatePeriod;

class TimeOffController extends RequestController
{
    private function _getGlobalDayOff($startDate, $endDate)
    {
        $globalDayOffs = GlobalDayOff::where('start_date', '<=', $endDate)
            ->where('end_date', '>=', $startDate)->get();

        $holidayDates = collect();

        foreach ($globalDayOffs as $globalDayOff) {
            $currentStartDate = max($globalDayOff->start_date, $startDate);
            $currentEndDate = min($globalDayOff->end_date, $endDate);

            $period = new DatePeriod(
                new DateTime($currentStartDate),
                new DateInterval('P1D'),
                (new DateTime($currentEndDate))->modify('+1 day')  // To include the end_date
            );

            foreach ($period as $date) {
                $holidayDates->push($date->format('Y-m-d'));
            }
        }

        return $holidayDates->unique()->toArray();
    }


    private function _updateAttendance($userId, $date, $attendanceCode, $leaveCategoryCode = null)
    {
        UserAttendance::updateOrCreate([
            "user_id" => $userId,
            "date" => $date
        ], [
            "attendance_code" => $attendanceCode,
            "day_off_code" => $leaveCategoryCode
        ]);
    }

    private function _createHistory($userId, $date, $approvalLine, $leaveCategoryName, $leaveCategoryCode)
    {
        UserLeaveHistory::create([
            "user_id" => $userId,
            "leave_category" => $leaveCategoryName,
            "code" => $leaveCategoryCode,
            "date" => $date,
            "approval_line" => $approvalLine
        ]);
    }

    private function _getSchedule($workingDayOff ,$start_date, $end_date)
    {
        Carbon::setLocale($this->constants->locale);

        $startDate = Carbon::parse($start_date);
        $endDate = Carbon::parse($end_date);

        $takenDates = [];
        $dayOffDates = [];

        $holidayDates = $this->_getGlobalDayOff($startDate, $endDate);

        while ($startDate <= $endDate) {
            $currentDate = $startDate->copy();
            $dayName = $currentDate->translatedFormat('l');

            if (!in_array($currentDate->toDateString(), $holidayDates)) {
                if (in_array($dayName, $workingDayOff)) {
                    array_push($dayOffDates, $currentDate->format('Y-m-d'));
                } else {
                    array_push($takenDates, $currentDate->format('Y-m-d'));
                }
            }

            $startDate->addDay();
        }

        return [
            "takenDates" => $takenDates,
            "dayOffDates" => $dayOffDates,
            "holidayDates" => $holidayDates
        ];
    }

    public function updateRequestStatus(Request $request)
    {
        try {
            $request->validate([
                "id" => "required",
                "status" => ["required", Rule::in(array_slice($this->constants->approve_status, 0, 3))],
                "comment" => "nullable"
            ]);

            $leaveRequest = UserLeaveRequest::whereId($request->id)->first();
            $userId = $leaveRequest->user->id;

            if (!$leaveRequest) {
                throw new NotFoundError("Time Off Request tidak ditemukan");
            }

            /** @var App\Models\User $user */
            $user = Auth::user();

            if ($user->hasPermissionTo('HC:change-all-status-request')) {
                if ($request->status == $this->constants->approve_status[1]) {
                    $workingDayOff = $leaveRequest
                        ->user
                        ->userEmployment
                        ->workingScheduleShift
                        ->workingSchedule
                        ->dayOffs
                        ->pluck('name')->toArray();

                    $leaveCategoryName = $leaveRequest->leaveRequestCategory->name;
                    $leaveCategoryCode = $leaveRequest->leaveRequestCategory->code;

                    $schedule = $this->_getSchedule(
                        $workingDayOff,
                        $leaveRequest->start_date,
                        $leaveRequest->end_date
                    );

                    if ($leaveRequest->taken != count($schedule["takenDates"])) {
                        $leaveRequest->update([
                            "taken" => count($schedule["takenDates"]),
                        ]);
                    }

                    collect($schedule["takenDates"])->map(function ($data) use (
                            $userId,
                            $leaveCategoryName,
                            $leaveCategoryCode,
                            $user
                        ) {
                        $this->_updateAttendance(
                            $userId,
                            $data,
                            $this->constants->attendance_code[1],
                            $leaveCategoryCode
                        );

                        $this->_createHistory(
                            $userId,
                            $data,
                            $user->name,
                            $leaveCategoryName,
                            $leaveCategoryCode
                        );
                    });

                    collect($schedule["dayOffDates"])->map(function ($data) use ($userId) {
                        $this->_updateAttendance(
                            $userId,
                            $data,
                            $this->constants->attendance_code[2]
                        );
                    });

                    collect($schedule["holidayDates"])->map(function ($data) use ($userId) {
                        $this->_updateAttendance(
                            $userId,
                            $data,
                            $this->constants->attendance_code[3]
                        );
                    });
                }

                $leaveRequest->update([
                    "approval_line" => $user->id,
                    "status" => $request->status,
                    "comment" => $request->comment
                ]);

                return response()->json([
                    "status" => "success",
                    "message" => "berhasil melakukan update status request time off"
                ]);
            }

            $approvalLine = $leaveRequest->user->userEmployment->approvalLine;

            if ($approvalLine->id != $user->id || !$user->hasPermissionTo('Approval:change-status-request')) {
                throw new AuthorizationError("Anda tidak berhak melakukan update status");
            }

            if ($leaveRequest->status == $this->constants->approve_status[1]) {
                throw new InvariantError("Tidak dapat melakukan update status, Request sudah di approve");
            }

            if ($leaveRequest->status == $this->constants->approve_status[2]) {
                throw new InvariantError("Tidak dapat melakukan update status, Request sudah di reject");
            }

            if ($request->status == $this->constants->approve_status[1]) {
                $workingDayOff = $leaveRequest
                    ->user
                    ->userEmployment
                    ->workingScheduleShift
                    ->workingSchedule
                    ->dayOffs
                    ->pluck('name')->toArray();

                $leaveCategoryName = $leaveRequest->leaveRequestCategory->name;
                $leaveCategoryCode = $leaveRequest->leaveRequestCategory->code;

                $schedule = $this->_getSchedule(
                    $workingDayOff,
                    $leaveRequest->start_date,
                    $leaveRequest->end_date
                );

                if ($leaveRequest->taken != count($schedule["takenDates"])) {
                    $leaveRequest->update([
                        "taken" => count($schedule["takenDates"]),
                    ]);
                }

                collect($schedule["takenDates"])->map(function ($data) use (
                        $userId,
                        $leaveCategoryName,
                        $leaveCategoryCode,
                        $user
                    ) {
                    $this->_updateAttendance(
                        $userId,
                        $data,
                        $this->constants->attendance_code[1],
                        $leaveCategoryCode
                    );

                    $this->_createHistory(
                        $userId,
                        $data,
                        $user->name,
                        $leaveCategoryName,
                        $leaveCategoryCode
                    );
                });

                collect($schedule["dayOffDates"])->map(function ($data) use ($userId) {
                    $this->_updateAttendance(
                        $userId,
                        $data,
                        $this->constants->attendance_code[2],
                    );
                });

                collect($schedule["holidayDates"])->map(function ($data) use ($userId) {
                    $this->_updateAttendance(
                        $userId,
                        $data,
                        $this->constants->attendance_code[3],
                    );
                });
            }

            $leaveRequest->update([
                "approval_line" => $user->id,
                "status" => $request->status,
                "comment" => $request->comment
            ]);

            return response()->json([
                "status" => "success",
                "message" => "berhasil melakukan update status request time off"
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getSummaries(Request $request)
    {
        try {
            /** @var App\Models\User $user */
            $user = Auth::user();
            $query = null;

            if ($user->hasPermissionTo('HC:view-all-request')) {
                $query = new UserLeaveRequest;
            } else if ($user->hasPermissionTo('Approval:view-request')) {
                $query = UserLeaveRequest::where(function ($query) use ($user) {
                    $query->where(function ($query) use ($user) {
                        $query->where('status', $this->constants->approve_status[0])
                            ->whereHas('user.userEmployment', function ($query) use ($user) {
                                $query->where('approval_line', $user->id);
                            });
                    })->orWhere('approval_line', $user->id);
                });
            } else {
                throw new AuthorizationError("Anda tidak berhak mengakses ini");
            }

            $search = $request->filters['search'];
            if (!empty($search)) {
                $query = $query->where(function ($query) use ($search) {
                    $query->whereHas('user', function ($query) use ($search) {
                        $query->where('name', 'LIKE', '%' . $search . '%');
                    })->orWhereHas('user.userEmployment', function ($query) use ($search) {
                        $query->where('employee_id', 'LIKE', '%' . $search . '%');
                    });
                });
            }

            $filterDivisi = $request->filters['filterDivisi'];
            if (!empty($filterDivisi) && $filterDivisi !== '*') {
                $query = $query->whereHas('user', function ($query) use ($filterDivisi) {
                    $query->where('division_id', $filterDivisi);
                });
            }

            $filterDepartment = $request->filters['filterDepartment'];
            if (!empty($filterDepartment) && $filterDepartment !== '*') {
                $query = $query->whereHas('user', function ($query) use ($filterDepartment) {
                    $query->where('department_id', $filterDepartment);
                });
            }

            $range_date = $request->filters['filterDate'] ? collect(explode('-', $request->filters['filterDate']))->map(function ($item) {
                return Carbon::parse($item)->toDateString();
            })->toArray() : [Carbon::now()->format('Y-m-d'), Carbon::now()->format('Y-m-d')];

            $allSummaries = $query->select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->get();

            $viewDate = $query->where(function ($query) use ($range_date) {
                    $query->whereBetween('start_date', $range_date)
                        ->orWhereBetween('end_date', $range_date);
                })
                ->select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->get();

            function formatter($collection)
            {
                $statuses = ['waiting' => 0, 'approved' => 0, 'rejected' => 0];

                foreach ($collection as $summary) {
                    $statuses[strtolower($summary->status)] = $summary->total;
                }

                return $statuses;
            }

            $allSummaries = formatter($allSummaries);
            $viewDate = formatter($viewDate);
            $viewDate["rangeDate"] = $range_date;

            return response()->json([
                "status" => "success",
                "data" => [
                    "allSummaries" => $allSummaries,
                    "viewDate" => $viewDate
                ]
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getTable(Request $request)
    {
        if (request()->ajax()) {
            /** @var App\Models\User $user */
            $user = Auth::user();
            $query = null;

            if ($user->hasPermissionTo('HC:view-all-request')) {
                $query = UserLeaveRequest::with([
                    'user.division', 'user.department', 'user.userEmployment.subBranch', 'leaveRequestCategory'
                ]);
            } else if ($user->hasPermissionTo('Approval:view-request')) {
                $query = UserLeaveRequest::where(function ($query) {
                    $query->where(function ($query) {
                        $query->where('status', $this->constants->approve_status[0])
                            ->whereHas('user.userEmployment', function ($query) {
                                $query->where('approval_line', Auth::user()->id);
                            });
                    })->orWhere('approval_line', Auth::user()->id);
                })->with(['user.division', 'user.department', 'user.userEmployment.subBranch', 'leaveRequestCategory']);
            } else {
                throw new AuthorizationError("Anda tidak berhak mengakses ini");
            }

            switch ($request->filters['filterStatus']) {
                case $this->constants->approve_status[0]:
                    $query = $query->where('status', $this->constants->approve_status[0]);
                    break;

                case $this->constants->approve_status[1]:
                    $query = $query->where('status', $this->constants->approve_status[1]);
                    break;

                case $this->constants->approve_status[2]:
                    $query = $query->where('status', $this->constants->approve_status[2]);
                    break;

                default:
                    $query = $query->orderByRaw("FIELD(status, ?, ?, ?)", array_slice($this->constants->approve_status, 0, 3));
                    break;
            };

            if ($request->filters['filterDate']) {
                $range_date = collect(explode('-', $request->filters['filterDate']))->map(function ($item) {
                    return Carbon::parse($item)->toDateString();
                })->toArray();

                $query = $query->where(function ($query) use ($range_date) {
                        $query->whereBetween('start_date', $range_date)
                            ->orWhereBetween('end_date', $range_date);
                    })->orderBy('start_date', 'desc');
            } else {
                $query = $query->orderBy('start_date', 'desc');
            }

            $filterDivisi = $request->filters['filterDivisi'];
            if (!empty($filterDivisi) && $filterDivisi !== '*') {
                $query = $query->whereHas('user', function ($query) use ($filterDivisi) {
                    $query->where('division_id', $filterDivisi);
                });
            }

            $filterDepartment = $request->filters['filterDepartment'];
            if (!empty($filterDepartment) && $filterDepartment !== '*') {
                $query = $query->whereHas('user', function ($query) use ($filterDepartment) {
                    $query->where('department_id', $filterDepartment);
                });
            }

            $search = $request->filters['search'];
            if (!empty($search)) {
                $query = $query->where(function ($query) use ($search) {
                    $query->whereHas('user', function ($query) use ($search) {
                        $query->where('name', 'LIKE', '%' . $search . '%');
                    })->orWhereHas('user.userEmployment', function ($query) use ($search) {
                        $query->where('employee_id', 'LIKE', '%' . $search . '%');
                    });
                });
            }

            return DataTables::of($query)
                ->addColumn('DT_RowChecklist', function ($check) {
                    return '<div class="text-center w-50px"><input name="emergency_contact_ids" type="checkbox" value="' . $check->id . '"></div>';
                })
                ->addColumn('name', function ($query) {
                    return $query->user->name;
                })
                ->addColumn('nip', function ($query) {
                    return $query->user->userEmployment->employee_id;
                })
                ->addColumn('date', function ($leaveRequest) {
                    return "$leaveRequest->start_date - $leaveRequest->end_date";
                })
                ->addColumn('branch', function ($query) {
                    return $query->user->userEmployment->subBranch->name;
                })
                ->addColumn('organization', function ($query) {
                    return $query->user->department->department_name;
                })
                ->addColumn('job_level', function ($query) {
                    return $query->user->getRoleNames()[0];
                })
                ->addColumn('job_position', function ($query) {
                    return $query->user->division->divisi_name;
                })
                ->addColumn('status', function ($query) {
                    $statusEnum = $this->constants->approve_status;
                    $status = $query->status;

                    return view('hc.cmt-request.components.status', compact(['statusEnum', 'status']));
                })
                ->addColumn('action', function ($query) {
                    $params = "#timeoff_modal";

                    $fileName = $query->file;
                    $fileLink = asset("/storage/request/timeoff/$fileName");

                    return view('hc.cmt-request.timeoff.menu', compact([
                        'params', 'query', 'fileName', 'fileLink'
                    ]));
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'DT_RowChecklist'])
                ->make(true);
        }
    }
}
