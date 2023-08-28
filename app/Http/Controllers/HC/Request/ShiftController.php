<?php

namespace App\Http\Controllers\HC\Request;

use Carbon\Carbon;
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
use App\Models\Attendance\UserShiftRequest;
use App\Models\Attendance\UserAttendance;
use App\Models\Employee\UserEmployment;
use Illuminate\Support\Facades\DB;


class ShiftController extends Controller
{
    private $errorHandler;
    private $constants;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
        $this->constants = new Constants();
    }

    private function _updateAttendance($userId, $date, $workingShift)
    {
        $userAttendance = UserAttendance::where('user_id', $userId)->where('date', $date)->first();

        if (!$userAttendance) {
            $primaryShift = UserEmployment::where('user_id', $userId)->first()->workingScheduleShift->workingShift;

            UserAttendance::create([
                'user_id' => $userId,
                'date' => $date,
                'attendance_code' => $this->constants->attendance_code[0],
                'primary_shift_name' => $primaryShift->name,
                'primary_working_start' => $primaryShift->working_start,
                'primary_working_end' => $primaryShift->working_end,
                'shift_changed' => true,
                'shift_name' => $workingShift->name,
                'working_start' => $workingShift->working_start,
                'working_end' => $workingShift->working_end,
                'overtime_before' => $workingShift->overtime_before,
                'overtime_after' => $workingShift->overtime_after,
                'late_check_in' => $workingShift->late_check_in,
                'late_check_out' => $workingShift->late_check_out,
                'start_attend' => $workingShift->start_attend,
                'end_attend' => $workingShift->end_attend,
            ]);
        } else {
            $userAttendance->update([
                'shift_changed' => true,
                'shift_name' => $workingShift->name,
                'working_start' => $workingShift->working_start,
                'working_end' => $workingShift->working_end,
                'overtime_before' => $workingShift->overtime_before,
                'overtime_after' => $workingShift->overtime_after,
                'late_check_in' => $workingShift->late_check_in,
                'late_check_out' => $workingShift->late_check_out,
                'start_attend' => $workingShift->start_attend,
                'end_attend' => $workingShift->end_attend,
            ]);
        }
    }

    public function updateRequestStatus(Request $request)
    {
        try {
            $request->validate([
                "id" => "required",
                "status" => ["required", Rule::in($this->constants->approve_status)],
                "comment" => "nullable"
            ]);

            $shiftRequest = UserShiftRequest::whereId($request->id)
                ->with('workingShift')->first();
            $approvalLine = $shiftRequest->user->userEmployment->approvalLine;

            if (!$shiftRequest) {
                throw new NotFoundError("Shift Request tidak ditemukan");
            }

            if (!$approvalLine) {
                if ($request->status == $this->constants->approve_status[1]) {
                    $this->_updateAttendance(
                        $shiftRequest->user_id,
                        $shiftRequest->date,
                        $shiftRequest->workingShift
                    );
                }

                $shiftRequest->update([
                    "approval_line" => $approvalLine->id,
                    "status" => $request->status,
                    "comment" => $request->comment
                ]);

                return response()->json([
                    "status" => "success",
                    "message" => "berhasil melakukan update status request shift"
                ]);
            }

            if ($approvalLine->id != Auth::user()->id) {
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
                    $shiftRequest->workingShift
                );
            }

            $shiftRequest->update([
                "approval_line" => $approvalLine->id,
                "status" => $request->status,
                "comment" => $request->comment
            ]);

            return response()->json([
                "status" => "success",
                "approval_line" => $approvalLine->id,
                "message" => "berhasil melakukan update status request shift"
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getSummaries(Request $request)
    {
        try {
            $query = UserShiftRequest::where(function ($query) {
                $query->where(function ($query) {
                    $query->where('status', $this->constants->approve_status[0])
                        ->whereHas('user.userEmployment', function ($query) {
                            $query->where('approval_line', Auth::user()->id);
                        });
                })->orWhere('approval_line', Auth::user()->id);
            });

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

            $viewDate = $query->whereBetween('date', $range_date)
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
            $query = UserShiftRequest::where(function ($query) {
                $query->where(function ($query) {
                    $query->where('status', $this->constants->approve_status[0])
                        ->whereHas('user.userEmployment', function ($query) {
                            $query->where('approval_line', Auth::user()->id);
                        });
                })->orWhere('approval_line', Auth::user()->id);
            })->with(['user.division', 'user.department', 'user.userEmployment.subBranch']);

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
                    $query = $query->orderByRaw("FIELD(status, ?, ?, ?)", $this->constants->approve_status);
                    break;
            };

            if ($request->filters['filterDate']) {
                $range_date = collect(explode('-', $request->filters['filterDate']))->map(function ($item) {
                    return Carbon::parse($item)->toDateString();
                })->toArray();

                $query = $query->whereBetween('date', $range_date)->orderBy('date', 'desc');
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
                    $params = "#shift_modal";
                    $shiftChanged = false;
                    $shift = "-";
                    $workHour = "-";
                    $prmshift = "-";
                    $prmworkHour = "-";

                    $userAttendance = UserAttendance::where('user_id', $query->user->id)
                        ->whereDate('date', $query->date)->first();

                    if (!$userAttendance) {
                        $workingShift = $query->user->userEmployment->workingScheduleShift->workingShift;
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

                    return view('hc.cmt-request.shift.menu', compact([
                        'params', 'query', 'shift', 'workHour', 'shiftChanged', 'prmshift', 'prmworkHour'
                    ]));
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'DT_RowChecklist'])
                ->make(true);
        }
    }
}
