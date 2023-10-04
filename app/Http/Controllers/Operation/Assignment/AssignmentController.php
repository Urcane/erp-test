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
use App\Models\Department;
use App\Models\Division;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AssignmentController extends Controller
{
    protected $errorHandler;
    protected $constants;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
        $this->constants = new Constants();
    }

    private function _updateAttendance()
    {
        // $this->info('Updating attendance...');
    }

    public function index()
    {
        $assignmentStatus = $this->constants->assignment_status;
        $dataDepartment = Department::all();

        return view('operation.assignment.index', compact([
            'assignmentStatus', 'dataDepartment'
        ]));
    }

    public function create()
    {
        $users = User::where('department_id', Auth::user()->department_id)
            ->where('id', '!=', Auth::user()->id)
            ->has('userEmployment')->has('division')
            ->with(['userEmployment', 'division'])
            ->get();

        return view('operation.assignment.create', compact(['users']));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'number' => 'required|string|max:255|unique:assignments',
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
                    return empty($request->input('people-name'));
                })],
                'people_name' => ['nullable', Rule::requiredIf(function () use ($request) {
                    return empty($request->input('cmt-id'));
                })],
                'people_nik' => 'array',
                'people_position' => 'array',
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
                foreach($request->cmt_id as $cmt_id) {
                    $assignment->userAssignments()->create([
                        "user_id" => $cmt_id,
                        "name" => null,
                        "position" => null,
                        "nik" => null,
                    ]);
                }
            }

            if ($request->people_name) {
                foreach($request->people_name as $key => $people_name) {
                    $assignment->userAssignments()->create([
                        "user_id" => null,
                        "name" => $people_name,
                        "position" => $request->people_position[$key],
                        "nik" => $request->people_nik[$key],
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                "status" => "success",
                "message" => "Berhasil membuat penugasan",
            ], 201);
        } catch (\Throwable $th) {
            DB::rollBack();

            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function show(string $id)
    {
        $assignment = Assignment::whereId($id)->first();
        $statusEnum = $this->constants->assignment_status;

        if (!$assignment) {
            return abort(404);
        }

        return view('operation.assignment.detail', compact([
            'assignment', 'statusEnum'
        ]));
    }

    public function edit(string $id)
    {
        $assignment = Assignment::whereId($id)->first();

        if (!$assignment) {
            return abort(404);
        }

        if ($assignment->status != $this->constants->assignment_status[0]) {
            return abort(404);
        }

        $users = User::where('department_id', Auth::user()->department_id)
            ->where('id', '!=', Auth::user()->id)
            ->has('userEmployment')->has('division')
            ->with(['userEmployment', 'division'])
            ->get();

        return view('operation.assignment.edit', compact([
            'assignment', 'users'
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
                'number' => ['required', 'string', 'max:255', Rule::unique('assignments')->ignore($assignment->id)],
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
                    return empty($request->input('people-name'));
                })],
                'people_name' => ['nullable', Rule::requiredIf(function () use ($request) {
                    return empty($request->input('cmt-id'));
                })],
                'people_nik' => 'array',
                'people_position' => 'array',
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
                foreach($request->cmt_id as $cmt_id) {
                    $assignment->userAssignments()->create([
                        "user_id" => $cmt_id,
                        "name" => null,
                        "position" => null,
                        "nik" => null,
                    ]);
                }
            }

            if ($request->people_name) {
                foreach($request->people_name as $key => $people_name) {
                    $assignment->userAssignments()->create([
                        "user_id" => null,
                        "name" => $people_name,
                        "position" => $request->people_position[$key],
                        "nik" => $request->people_nik[$key],
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
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getTableAssignment(Request $request)
    {
        if (request()->ajax()) {
            $assignments = Assignment::query();

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

            $filterDepartment = $request->filters['filterDepartment'];
            if (!empty($filterDepartment) && $filterDepartment !== '*') {
                $assignments = $assignments->whereHas('user', function ($query) use ($filterDepartment) {
                    $query->where('department_id', $filterDepartment);
                });
            }

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
            }

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
                    return $query->signedBy ? $query->signedBy->name : $query->user->name;
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
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function updateStatus(Request $request)
    {
        try {
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

            if ($request->status == $this->constants->assignment_status[1]) {
                $this->_updateAttendance();
            }

            $assignment->update([
                "status" => $request->status,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil mengubah status penugasan",
            ], 200);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function exportPdf(string $assignment, string $user)
    {
        $assignment = Assignment::whereId($assignment)->first();

        if (!$assignment) {
            return abort(404);
        }

        $userAssignment = $assignment->userAssignments()->whereId($user)->first();

        if (!$userAssignment) {
            return abort(404);
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

        return view('operation.assignment.pdf', compact([
            'assignment', 'user', 'signed'
        ]));
    }
}
