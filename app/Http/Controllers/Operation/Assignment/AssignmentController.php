<?php

namespace App\Http\Controllers\Operation\Assignment;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

use App\Constants;
use App\Exceptions\AuthorizationError;
use App\Exceptions\InvariantError;
use App\Exceptions\NotFoundError;
use App\Models\Assignment\Assignment;
use App\Utils\ErrorHandler;
use App\Http\Controllers\Controller;
use App\Models\Attendance\GlobalDayOff;
use App\Models\Attendance\UserAttendance;
use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AssignmentController extends Controller
{
    protected $constants;

    public function __construct()
    {
        $this->constants = new Constants();
    }

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

    private function _updateAttendance(mixed $assignment)
    {
        $workSchedules = $assignment->assignmentWorkSchedules->pluck('day')->toArray();
        $startDate = Carbon::parse($assignment->start_date);
        $endDate = Carbon::parse($assignment->end_date);

        $holidayDates = $assignment->override_holiday ? [] : $this->_getGlobalDayOff($startDate, $endDate);

        $dayNames = [
            'Minggu',
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
        ];

        $assignment->userAssignments->map(function ($userAssignment) use (
            $assignment,
            $startDate,
            $endDate,
            $workSchedules,
            $holidayDates,
            $dayNames
        ) {
            if ($userAssignment->user_id) {
                $startDateCopy = $startDate->copy();

                while ($startDateCopy->lte($endDate)) {
                    if (in_array($startDateCopy, $holidayDates)) {
                        UserAttendance::updateOrCreate([
                            'user_id' => $userAssignment->user_id,
                            'date' => $startDateCopy,
                        ], [
                            'attendance_code' => $this->constants->attendance_code[3],
                            'shift_name' => null,
                            'working_start' => null,
                            'working_end' => null,
                            'overtime_before' => 0,
                            'overtime_after' => 0,
                            'late_check_in' => 0,
                            'late_check_out' => 0,
                            'start_attend' => null,
                            'end_attend' => null,
                            'check_in' => null,
                            'check_out' => null,
                            'check_in_latitude' => null,
                            'check_in_longitude' => null,
                            'check_out_latitude' => null,
                            'check_out_longitude' => null,
                            'overtime' => 0,
                        ]);
                    } else if (in_array($dayNames[$startDateCopy->dayOfWeek], $workSchedules)) {
                        UserAttendance::updateOrCreate([
                            'user_id' => $userAssignment->user_id,
                            'date' => $startDateCopy,
                        ], [
                            'attendance_code' => $this->constants->attendance_code[4],
                            'shift_name' => "Dinas Luar",
                            'working_start' => $assignment->working_start,
                            'working_end' => $assignment->working_end,
                            'overtime_before' => 0,
                            'overtime_after' => 0,
                            'late_check_in' => 0,
                            'late_check_out' => 0,
                            'start_attend' => null,
                            'end_attend' => null,
                            'check_in' => null,
                            'check_out' => null,
                            'check_in_latitude' => null,
                            'check_in_longitude' => null,
                            'check_out_latitude' => null,
                            'check_out_longitude' => null,
                            'overtime' => 0,
                        ]);
                    } else {
                        UserAttendance::updateOrCreate([
                            'user_id' => $userAssignment->user_id,
                            'date' => $startDateCopy,
                        ], [
                            'attendance_code' => $this->constants->attendance_code[2],
                            'shift_name' => null,
                            'working_start' => null,
                            'working_end' => null,
                            'overtime_before' => 0,
                            'overtime_after' => 0,
                            'late_check_in' => 0,
                            'late_check_out' => 0,
                            'start_attend' => null,
                            'end_attend' => null,
                            'check_in' => null,
                            'check_out' => null,
                            'check_in_latitude' => null,
                            'check_in_longitude' => null,
                            'check_out_latitude' => null,
                            'check_out_longitude' => null,
                            'overtime' => 0,
                        ]);
                    }

                    $startDateCopy->addDay();
                }
            }
        });
    }

    public function index()
    {
        /** @var \App\Models\User $authUser */
        $authUser = Auth::user();

        if (!$authUser->hasPermissionTo('OPR:view-department-assignment')) {
            abort(403);
        }

        $assignmentStatus = $this->constants->assignment_status;
        // $dataDepartment = Department::all();

        return view('operation.assignment.index', compact([
            'assignmentStatus'
        ]));
    }

    public function create()
    {
        /** @var \App\Models\User $authUser */
        $authUser = Auth::user();

        if (!$authUser->hasPermissionTo('OPR:create-department-assignment')) {
            abort(403);
        }

        $days = $this->constants->day;

        $users = User::where('department_id', Auth::user()->department_id)
            ->has('userEmployment')->has('division')
            ->with(['userEmployment', 'division'])
            ->get();

        return view('operation.assignment.create', compact([
            'users', 'days'
        ]));
    }

    public function store(Request $request)
    {
        try {
            /** @var \App\Models\User $authUser */
            $authUser = Auth::user();

            if (!$authUser->hasPermissionTo('OPR:create-department-assignment')) {
                throw new AuthorizationError("Anda tidak berhak membuat penugasan");
            }

            $request->validate([
                'number' => 'required|string|max:255',
                'signed_by' => 'required|exists:users,id',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'override_holiday' => 'nullable',
                'name' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'latitude' => 'required|string|max:50',
                'longitude' => 'required|string|max:50',
                'working_start' => 'required|date_format:H:i',
                'working_end' => 'required|date_format:H:i|after:working_start',
                'radius' => 'integer',
                'purpose' => 'required|string',
                'cmt_id' => ['nullable', Rule::requiredIf(function () use ($request) {
                    return empty($request->input('people_name'));
                })],
                'people_name' => ['nullable', Rule::requiredIf(function () use ($request) {
                    return empty($request->input('cmt_id'));
                })],
                'people_nik' => 'array',
                'people_position' => 'array',
                'work_schedule' => 'array',
            ]);

            DB::beginTransaction();

            $assignment = Assignment::create([
                "number" => $request->number,
                "signed_by" => $request->signed_by,
                "user_id" => Auth::user()->id,
                "start_date" => $request->start_date,
                "end_date" => $request->end_date,
                "override_holiday" => (bool) $request->override_holiday,
                "name" => $request->name,
                "location" => $request->location,
                "latitude" => $request->latitude,
                "longitude" => $request->longitude,
                "working_start" => $request->working_start,
                "working_end" => $request->working_end,
                "radius" => $request->radius,
                "purpose" => $request->purpose,
            ]);

            if ($request->cmt_id) {
                foreach ($request->cmt_id as $cmt_id) {
                    $assignment->userAssignments()->create([
                        "user_id" => $cmt_id,
                        "name" => null,
                        "position" => null,
                        "nik" => null,
                    ]);
                }
            }

            if ($request->people_name) {
                foreach ($request->people_name as $key => $people_name) {
                    $assignment->userAssignments()->create([
                        "user_id" => null,
                        "name" => $people_name,
                        "position" => $request->people_position[$key],
                        "nik" => $request->people_nik[$key],
                    ]);
                }
            }

            foreach ($request->work_schedule as $day) {
                $assignment->assignmentWorkSchedules()->create([
                    "day" => $day,
                ]);
            }

            DB::commit();

            return response()->json([
                "status" => "success",
                "message" => "Berhasil membuat penugasan",
            ], 201);
        } catch (\Throwable $th) {
            DB::rollBack();

            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function show(string $id)
    {
        $assignment = Assignment::whereId($id)->first();
        $statusEnum = $this->constants->assignment_status;
        $days = $this->constants->day;

        if (!$assignment) {
            return abort(404);
        }

        /** @var \App\Models\User $authUser */
        $authUser = Auth::user();

        if (
            ($authUser->hasPermissionTo('OPR:view-department-assignment') ||
                $assignment->user->department_id != $authUser->department_id) &&
            ($authUser->id !== $assignment->user_id &&
                !$assignment->userAssignments->contains('user_id', $authUser->id))
        ) {
            abort(403);
        }

        return view('operation.assignment.detail', compact([
            'assignment', 'statusEnum', 'days'
        ]));
    }

    public function edit(string $id)
    {
        $assignment = Assignment::whereId($id)->first();

        if (!$assignment) {
            return abort(404);
        }

        if ($assignment->status != $this->constants->assignment_status[0]) {
            return abort(400);
        }

        if ($assignment->user_id != Auth::user()->id) {
            return abort(403);
        }

        $users = User::where('department_id', Auth::user()->department_id)
            ->where('id', '!=', Auth::user()->id)
            ->has('userEmployment')->has('division')
            ->with(['userEmployment', 'division'])
            ->get();

        $days = $this->constants->day;

        return view('operation.assignment.edit', compact([
            'assignment', 'users', 'days'
        ]));
    }

    public function update(Request $request)
    {
        try {
            $assignment = Assignment::whereId($request->id)->first();

            if (!$assignment) {
                throw new NotFoundError("Penugasan tidak ditemukan");
            }

            if ($assignment->user_id != Auth::user()->id) {
                throw new AuthorizationError("Anda tidak berhak mengubah penugasan ini");
            }

            if ($assignment->status != $this->constants->assignment_status[0]) {
                throw new InvariantError("Tidak dapat mengubah penugasan, Penugasan sudah $assignment->status");
            }

            $request->validate([
                'number' => ['required', 'string', 'max:255'],
                'signed_by' => 'required|exists:users,id',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'override_holiday' => 'nullable',
                'name' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'latitude' => 'required|string|max:50',
                'longitude' => 'required|string|max:50',
                'working_start' => 'required|date_format:H:i',
                'working_end' => 'required|date_format:H:i|after:working_start',
                'radius' => 'integer',
                'purpose' => 'required|string',
                'cmt_id' => ['nullable', Rule::requiredIf(function () use ($request) {
                    return empty($request->input('people_name'));
                })],
                'people_name' => ['nullable', Rule::requiredIf(function () use ($request) {
                    return empty($request->input('cmt_id'));
                })],
                'people_nik' => 'array',
                'people_position' => 'array',
                'work_schedule' => 'array',
            ]);

            DB::beginTransaction();

            $assignment->update([
                "number" => $request->number,
                "signed_by" => $request->signed_by,
                "start_date" => $request->start_date,
                "end_date" => $request->end_date,
                "override_holiday" => (bool) $request->override_holiday,
                "name" => $request->name,
                "location" => $request->location,
                "latitude" => $request->latitude,
                "longitude" => $request->longitude,
                "working_start" => $request->working_start,
                "working_end" => $request->working_end,
                "radius" => $request->radius,
                "purpose" => $request->purpose,
            ]);

            $assignment->userAssignments()->delete();

            if ($request->cmt_id) {
                foreach ($request->cmt_id as $cmt_id) {
                    $assignment->userAssignments()->create([
                        "user_id" => $cmt_id,
                        "name" => null,
                        "position" => null,
                        "nik" => null,
                    ]);
                }
            }

            if ($request->people_name) {
                foreach ($request->people_name as $key => $people_name) {
                    $assignment->userAssignments()->create([
                        "user_id" => null,
                        "name" => $people_name,
                        "position" => $request->people_position[$key],
                        "nik" => $request->people_nik[$key],
                    ]);
                }
            }

            $assignment->assignmentWorkSchedules()->delete();

            if ($request->work_schedule) {
                foreach ($request->work_schedule as $day) {
                    $assignment->assignmentWorkSchedules()->create([
                        "day" => $day,
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                "status" => "success",
                "message" => "Berhasil mengubah penugasan",
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getTableAssignment(Request $request)
    {
        if (request()->ajax()) {
            /** @var \App\Models\User $authUser */
            $authUser = Auth::user();

            if (!$authUser->hasPermissionTo('OPR:view-department-assignment')) {
                throw new AuthorizationError("Anda tidak berhak melihat penugasan");
            }

            $assignments = Assignment::whereHas('user', function ($query) use ($authUser) {
                $query->where('department_id', $authUser->department->id);
            })
                ->with(['user', 'signedBy', 'userAssignments']);

            switch ($request->filters['filterStatus']) {
                case $this->constants->assignment_status[0]:
                    $assignments = $assignments->where('status', $this->constants->assignment_status[0]);
                    break;
                case $this->constants->assignment_status[1]:
                    $assignments = $assignments->where('status', $this->constants->assignment_status[1]);
                    break;
                case $this->constants->assignment_status[2]:
                    $assignments = $assignments->where('status', $this->constants->assignment_status[2]);
                    break;
                case $this->constants->assignment_status[3]:
                    $assignments = $assignments->where('status', $this->constants->assignment_status[3]);
                    break;
                case $this->constants->assignment_status[4]:
                    $assignments = $assignments->where('status', $this->constants->assignment_status[4]);
                    break;
                default:
                    $assignments = $assignments->orderByRaw(
                        "FIELD(status, ?, ?, ?, ?, ?)",
                        $this->constants->assignment_status
                        // [
                        //     $this->constants->assignment_status[1],
                        //     $this->constants->assignment_status[0],
                        //     ...array_slice($this->constants->assignment_status, 2, count($this->constants->assignment_status))
                        // ]
                    );
                    break;
            }

            if ($request->filters['filterDate']) {
                $range_date = collect(explode('-', $request->filters['filterDate']))->map(function ($item, $key) {
                    $date = Carbon::parse($item);
                    if ($key === 0) {
                        return $date->startOfDay()->toDateTimeString();
                    } else {
                        return $date->endOfDay()->toDateTimeString();
                    }
                })->toArray();

                $assignments = $assignments->whereBetween('created_at', $range_date)->orderBy('created_at', 'desc');
            } else {
                $assignments = $assignments->orderBy('created_at', 'desc');
            }

            $search = $request->filters['search'];
            if (!empty($search)) {
                $assignments = $assignments->where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('location', 'LIKE', '%' . $search . '%')
                        ->orWhere('number', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('user', function ($query) use ($search) {
                            $query->where('name', 'LIKE', '%' . $search . '%');
                        })
                        ->orWhereHas('signedBy', function ($query) use ($search) {
                            $query->where('name', 'LIKE', '%' . $search . '%');
                        });
                });
            }

            // $filterDepartment = $request->filters['filterDepartment'];
            // if (!empty($filterDepartment) && $filterDepartment !== '*') {
            //     $assignments = $assignments->whereHas('user', function ($query) use ($filterDepartment) {
            //         $query->where('department_id', $filterDepartment);
            //     });
            // }

            return DataTables::of($assignments)
                ->addColumn('name', function ($query) {
                    return $query->name;
                })
                ->addColumn('date', function ($query) {
                    return Carbon::parse($query->start_date)->format('d/m/Y') . ' - ' . Carbon::parse($query->end_date)->format('d/m/Y');
                })
                ->addColumn('created_at', function ($query) {
                    $date = explode(" ", explode("T", $query->created_at)[0])[0];

                    $date = Carbon::createFromFormat('Y-m-d', $date);
                    $formattedDate = $date->format('d-m-Y');

                    return $formattedDate;
                })
                ->addColumn('signed_by', function ($query) {
                    return $query->signedBy->name;
                })
                ->addColumn('assigned', function ($query) {
                    return $query->userAssignments->count() . " Employee(s)";
                })
                ->addColumn('action', function ($query) {
                    $statusEnum = $this->constants->assignment_status;

                    return view('operation.assignment.components.menu', compact(['query', 'statusEnum']));
                })
                ->addColumn('status', function ($query) {
                    $statusEnum = $this->constants->assignment_status;
                    $status = $query->status;

                    return view('operation.assignment.components.status', compact([
                        'status', 'statusEnum'
                    ]));
                })
                ->addColumn('created_by', function ($query) {
                    return $query->user->name;
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }

    public function cancel(Request $request)
    {
        try {
            $assignment = Assignment::whereId($request->id)->first();

            if (!$assignment) {
                throw new NotFoundError("Penugasan tidak ditemukan");
            }

            if ($assignment->user_id != Auth::user()->id) {
                throw new AuthorizationError("Anda tidak berhak membatalkan penugasan ini");
            }

            if ($assignment->status != $this->constants->assignment_status[0]) {
                throw new InvariantError("Tidak dapat membatalkan penugasan, Penugasan sudah $assignment->status");
            }

            $assignment->update([
                "status" => $this->constants->assignment_status[3],
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil membatalkan penugasan",
            ], 200);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            /** @var \App\Models\User $authUser */
            $authUser = Auth::user();

            if (!$authUser->hasPermissionTo('OPR:change-department-status-assignment')) {
                throw new AuthorizationError("Anda tidak berhak mengubah status penugasan");
            }

            $request->validate([
                'assignment_id' => 'required',
                'status' => ['required', Rule::in($this->constants->assignment_status)],
            ]);

            $assignment = Assignment::whereId($request->assignment_id)->first();

            if (!$assignment) {
                throw new NotFoundError("Penugasan tidak ditemukan");
            }

            if ($assignment->status != $this->constants->assignment_status[0]) {
                throw new InvariantError("Tidak dapat melakukan update status, Penugasan sudah $assignment->status");
            }

            DB::beginTransaction();

            if ($request->status == $this->constants->assignment_status[1]) {
                // if (Carbon::parse($assignment->start_date)->addDay()->lt(Carbon::now())) {
                //     $assignment->update([
                //         "status" => $this->constants->assignment_status[4],
                //         "approval_line" => null,
                //     ]);

                //     DB::commit();
                //     throw new InvariantError("Tidak dapat melakukan menyetujui, Penugasan sudah expired");
                // }
                $this->_updateAttendance($assignment);
            }

            $assignment->update([
                "status" => $request->status,
                "approval_line" => Auth::user()->id,
            ]);

            DB::commit();

            return response()->json([
                "status" => "success",
                "message" => "Berhasil mengubah status penugasan",
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function exportPdf(string $assignment, string $user)
    {
        $assignment = Assignment::whereId($assignment)->first();

        if (!$assignment) {
            return abort(404);
        }

        if ($assignment->status != $this->constants->assignment_status[1]) {
            return abort(400);
        }

        $userAssignment = $assignment->userAssignments()->whereId($user)->first();

        if (!$userAssignment) {
            return abort(404);
        }

        /** @var \App\Models\User $authUser */
        $authUser = Auth::user();

        if (
            !($authUser->hasPermissionTo('OPR:view-department-assignment')
                || $authUser->id == $userAssignment->user_id)
        ) {
            if ($userAssignment->user_id !== $authUser->id) {
                abort(403);
            }
        }

        if ($userAssignment->user_id) {
            $user = [
                'name' => $userAssignment->user->name,
                'nik' => $userAssignment->user->userEmployment->employee_id,
                'position' => $userAssignment->user->division->divisi_name,
            ];
        } else {
            $user = [
                'name' => $userAssignment->name,
                'nik' => $userAssignment->nik,
                'position' => $userAssignment->position,
            ];
        }

        if ($assignment->signed_by) {
            $signed = [
                'name' => $assignment->signedBy->name,
                'nik' => $assignment->signedBy->userEmployment->employee_id,
                'position' => $assignment->signedBy->division->divisi_name,
            ];
        } else {
            $signed = [
                'name' => $assignment->user->name,
                'nik' => $assignment->user->userEmployment->employee_id,
                'position' => $assignment->user->division->divisi_name,
            ];
        }

        $url = route('validate-letter.assignment', [
            'assignment' => encrypt($assignment->id),
            'userId' => encrypt($userAssignment->id),
        ]);

        $qrCode = QrCode::size(100)->generate($url);

        return view('operation.assignment.pdf', compact([
            'assignment', 'user', 'signed', 'qrCode'
        ]));
    }
}
