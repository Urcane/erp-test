<?php

namespace App\Http\Controllers\HC\Request;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rule;

use App\Exceptions\AuthorizationError;
use App\Exceptions\InvariantError;
use App\Exceptions\NotFoundError;
use App\Models\Attendance\AttendanceChangeLog;
use App\Models\Attendance\UserAttendanceRequest;
use App\Models\Attendance\UserAttendance;
use App\Models\Employee\UserEmployment;
use Illuminate\Support\Facades\DB;

class AttendanceController extends RequestController
{
    private function _updateAttendance($userId, $date, $checkIn, $checkOut)
    {
        $userAttendance = UserAttendance::where('user_id', $userId)->where('date', $date)->first();

        if (!$userAttendance) {
            $workingShift = UserEmployment::where('user_id', $userId)->first()->workingScheduleShift->workingShift;

            $attendance = UserAttendance::create([
                'user_id' => $userId,
                'date' => $date,
                'attendance_code' => $this->constants->attendance_code[0],
                'shift_name' => $workingShift->name,
                'working_start' => $workingShift->working_start,
                'working_end' => $workingShift->working_end,
                'overtime_before' => $workingShift->overtime_before,
                'overtime_after' => $workingShift->overtime_after,
                'late_check_in' => $workingShift->late_check_in,
                'late_check_out' => $workingShift->late_check_out,
                'start_attend' => $workingShift->start_attend,
                'end_attend' => $workingShift->end_attend,
                'check_in' => $checkIn,
                'check_out' => $checkOut,
            ]);

            AttendanceChangeLog::create([
                "user_id" => Auth::user()->id,
                "attendance_id" => $attendance->id,
                "date" => $date,
                "action" => "SYSTEM EDIT",
                "old_check_in" => null,
                "old_check_out" => null,
                "new_check_in" => $checkIn ?? null,
                "new_check_out" => $checkOut ?? null,
                "reason" => "[CHANGED FROM USER REQUEST --SYSTEM]"
            ]);
        } else {
            $userAttendance->update([
                "check_in" => $checkIn ?? $userAttendance->check_in,
                "check_out" => $checkOut ?? $userAttendance->check_out
            ]);

            AttendanceChangeLog::create([
                "user_id" => Auth::user()->id,
                "attendance_id" => $userAttendance->id,
                "date" => $userAttendance->date,
                "action" => "SYSTEM EDIT",
                "old_check_in" => $userAttendance->check_in,
                "old_check_out" => $userAttendance->check_out,
                "new_check_in" => $checkIn ?? $userAttendance->check_in,
                "new_check_out" => $checkOut ?? $userAttendance->check_out,
                "reason" => "[CHANGED FROM USER REQUEST --SYSTEM]"
            ]);
        }
    }

    public function updateRequestStatus(Request $request)
    {
        try {
            $request->validate([
                "id" => "required",
                "status" => ["required", Rule::in(array_slice($this->constants->approve_status, 0, 3))],
                "comment" => "nullable"
            ]);

            $attendanceRequest = UserAttendanceRequest::whereId($request->id)->first();

            if (!$attendanceRequest) {
                throw new NotFoundError("Attendance Request tidak ditemukan");
            }

            /** @var App\Models\User $user */
            $user = Auth::user();

            if ($user->hasPermissionTo('HC:change-all-status-request')) {
                if ($request->status == $this->constants->approve_status[1]) {
                    $this->_updateAttendance(
                        $attendanceRequest->user_id,
                        $attendanceRequest->date,
                        $attendanceRequest->check_in,
                        $attendanceRequest->check_out
                    );
                }

                $attendanceRequest->update([
                    "approval_line" => $user->id,
                    "status" => $request->status,
                    "comment" => $request->comment
                ]);

                return response()->json([
                    "status" => "success",
                    "message" => "berhasil melakukan update status request attendance"
                ]);
            }

            $approvalLine = $attendanceRequest->user->userEmployment->approvalLine;

            if ($approvalLine->id != $user->id || !$user->hasPermissionTo('Approval:change-status-request')) {
                throw new AuthorizationError("Anda tidak berhak melakukan update status");
            }

            if ($attendanceRequest->status == $this->constants->approve_status[1]) {
                throw new InvariantError("Tidak dapat melakukan update status, Request sudah di approve");
            }

            if ($attendanceRequest->status == $this->constants->approve_status[2]) {
                throw new InvariantError("Tidak dapat melakukan update status, Request sudah di reject");
            }

            if ($request->status == $this->constants->approve_status[1]) {
                $this->_updateAttendance(
                    $attendanceRequest->user_id,
                    $attendanceRequest->date,
                    $attendanceRequest->check_in,
                    $attendanceRequest->check_out
                );
            }

            $attendanceRequest->update([
                "approval_line" => $user->id,
                "status" => $request->status,
                "comment" => $request->comment
            ]);

            return response()->json([
                "status" => "success",
                "message" => "berhasil melakukan update status request attendance"
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
                $query = new UserAttendanceRequest;
            } else if ($user->hasPermissionTo('Approval:view-request')) {
                $query = UserAttendanceRequest::where(function ($query) use ($user) {
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

            $viewDate = $query->whereBetween('created_at', $range_date)
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
                $query = UserAttendanceRequest::whereIn('status', array_slice($this->constants->approve_status, 0, 3))
                    ->with(['user.division', 'user.department', 'user.userEmployment.subBranch']);
            } else if ($user->hasPermissionTo('Approval:view-request')) {
                $query = UserAttendanceRequest::where(function ($query) {
                    $query->where(function ($query) {
                        $query->where('status', $this->constants->approve_status[0])
                            ->whereHas('user.userEmployment', function ($query) {
                                $query->where('approval_line', Auth::user()->id);
                            });
                    })->orWhere('approval_line', Auth::user()->id);
                })->with(['user.division', 'user.department', 'user.userEmployment.subBranch']);
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

                $query = $query->whereBetween('created_at', $range_date)->orderBy('date', 'desc');
            } else {
                $query = $query->orderBy('date', 'desc');
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
                ->addColumn('date', function ($query) {
                    return $query->date;
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
                    $params = "#attendances_modal";
                    $shift = "-";
                    $workHour = "-";

                    $userAttendance = UserAttendance::where('user_id', $query->user->id)
                        ->whereDate('date', $query->date)->first();

                    if (!$userAttendance) {
                        $workingShift = $query->user->userEmployment->workingScheduleShift->workingShift;
                        $shift = $workingShift->name;
                        $workHour = "$workingShift->working_start - $workingShift->working_end";
                    } else {
                        $shift = $userAttendance->shift_name;
                        $workHour = "$userAttendance->working_start - $userAttendance->working_end";
                    }

                    $fileName = $query->file;
                    $fileLink = asset("/storage/request/attendance/$fileName");

                    return view('hc.cmt-request.attendance.menu', compact([
                        'params',
                        'query',
                        'shift',
                        'workHour',
                        'fileName',
                        'fileLink'
                    ]));
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'DT_RowChecklist'])
                ->make(true);
        }
    }
}
