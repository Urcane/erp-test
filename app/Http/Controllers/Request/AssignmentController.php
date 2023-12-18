<?php

namespace App\Http\Controllers\Request;

use App\Constants;
use App\Exceptions\AuthorizationError;
use App\Exceptions\InvariantError;
use App\Exceptions\NotFoundError;
use App\Http\Controllers\Controller;
use App\Models\Assignment\Assignment;
use App\Models\User;
use App\Utils\ErrorHandler;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class AssignmentController extends Controller
{
    private $constants;

    public function __construct()
    {
        $this->constants = new Constants();
    }

    public function create()
    {
        $users = User::where('department_id', Auth::user()->department_id)
            ->has('userEmployment')->has('division')
            ->with(['userEmployment', 'division'])
            ->get();

        $days = $this->constants->day;

        return view('profile.part-profile.time-management-part.assignment.create', compact([
            'users', 'days'
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

        return view('profile.part-profile.time-management-part.assignment.edit', compact([
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

    public function makeRequest(Request $request)
    {
        try {
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

            $assignment->userAssignments()->create([
                "user_id" => Auth::user()->id,
                "name" => null,
                "position" => null,
                "nik" => null,
            ]);

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

        if ($authUser->id !== $assignment->user_id) {
            if (
                !$assignment->userAssignments->contains('user_id', $authUser->id) ||
                $assignment->status != $this->constants->assignment_status[1]
            ) {
                abort(403);
            }
        }

        return view('operation.assignment.detail', compact([
            'assignment', 'statusEnum', 'days'
        ]));
    }

    public function cancelRequest(Request $request)
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

    public function showActiveRequest(Request $request)
    {
        if (request()->ajax()) {
            /** @var \App\Models\User $user */
            $user = Auth::user();

            if (!($user->id == $request->user_id || $user->hasPermissionTo('HC:view-attendance'))) {
                throw new AuthorizationError("Anda tidak berhak mengakses resource ini");
            }

            $assignments = Assignment::whereHas('userAssignments', function ($query) use ($request) {
                $query->where('user_id', $request->user_id);
            })->where('status', $this->constants->assignment_status[1])
                ->orderBy('created_at', 'desc')
                ->with(['user', 'signedBy', 'userAssignments']);

            // if ($request->filters['filterDate']) {
            //     $range_date = collect(explode('-', $request->filters['filterDate']))->map(function ($item, $key) {
            //         $date = Carbon::parse($item);
            //         if ($key === 0) {
            //             return $date->startOfDay()->toDateTimeString();
            //         } else {
            //             return $date->endOfDay()->toDateTimeString();
            //         }
            //     })->toArray();

            //     $assignments = $assignments->whereBetween('created_at', $range_date)->orderBy('created_at', 'desc');
            // } else {
            //     $assignments = $assignments->orderBy('created_at', 'desc');
            // }

            // $search = $request->filters['search'];
            // if (!empty($search)) {
            //     $assignments = $assignments->where(function ($query) use ($search) {
            //         $query->where('name', 'LIKE', '%' . $search . '%')
            //             ->orWhere('location', 'LIKE', '%' . $search . '%')
            //             ->orWhere('number', 'LIKE', '%' . $search . '%')
            //             ->orWhereHas('user', function ($query) use ($search) {
            //                 $query->where('name', 'LIKE', '%' . $search . '%');
            //             })
            //             ->orWhereHas('signedBy', function ($query) use ($search) {
            //                 $query->where('name', 'LIKE', '%' . $search . '%');
            //             });
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
                ->addColumn('action', function ($query) {
                    $statusEnum = $this->constants->assignment_status;

                    return view('profile.part-profile.time-management-part.assignment.components.active-menu', compact([
                        'query'
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

    public function showRequestTable(Request $request)
    {
        if (request()->ajax()) {
            /** @var \App\Models\User $user */
            $user = Auth::user();

            if (!($user->id == $request->user_id || $user->hasPermissionTo('HC:view-attendance'))) {
                throw new AuthorizationError("Anda tidak berhak mengakses resource ini");
            }

            $assignments = Assignment::where('user_id', $request->user_id)
                ->orderByRaw(
                    "FIELD(status, ?, ?, ?, ?, ?)",
                    $this->constants->assignment_status
                    // [
                    //     $this->constants->assignment_status[1],
                    //     $this->constants->assignment_status[0],
                    //     ...array_slice($this->constants->assignment_status, 2, count($this->constants->assignment_status))
                    // ]
                )
                ->with(['user', 'signedBy', 'userAssignments']);

            // switch ($request->filters['filterStatus']) {
            //     case $this->constants->assignment_status[0]:
            //         $assignments = $assignments->where('status', $this->constants->assignment_status[0]);
            //         break;
            //     case $this->constants->assignment_status[1]:
            //         $assignments = $assignments->where('status', $this->constants->assignment_status[1]);
            //         break;
            //     case $this->constants->assignment_status[2]:
            //         $assignments = $assignments->where('status', $this->constants->assignment_status[2]);
            //         break;
            //     case $this->constants->assignment_status[3]:
            //         $assignments = $assignments->where('status', $this->constants->assignment_status[3]);
            //         break;
            //     case $this->constants->assignment_status[4]:
            //         $assignments = $assignments->where('status', $this->constants->assignment_status[4]);
            //         break;
            //     default:
            //         $assignments = $assignments->orderByRaw(
            //             "FIELD(status, ?, ?, ?, ?, ?)",
            //             $this->constants->assignment_status
            //             // [
            //             //     $this->constants->assignment_status[1],
            //             //     $this->constants->assignment_status[0],
            //             //     ...array_slice($this->constants->assignment_status, 2, count($this->constants->assignment_status))
            //             // ]
            //         );
            //         break;
            // }

            // if ($request->filters['filterDate']) {
            //     $range_date = collect(explode('-', $request->filters['filterDate']))->map(function ($item, $key) {
            //         $date = Carbon::parse($item);
            //         if ($key === 0) {
            //             return $date->startOfDay()->toDateTimeString();
            //         } else {
            //             return $date->endOfDay()->toDateTimeString();
            //         }
            //     })->toArray();

            //     $assignments = $assignments->whereBetween('created_at', $range_date)->orderBy('created_at', 'desc');
            // } else {
            //     $assignments = $assignments->orderBy('created_at', 'desc');
            // }

            // $search = $request->filters['search'];
            // if (!empty($search)) {
            //     $assignments = $assignments->where(function ($query) use ($search) {
            //         $query->where('name', 'LIKE', '%' . $search . '%')
            //             ->orWhere('location', 'LIKE', '%' . $search . '%')
            //             ->orWhere('number', 'LIKE', '%' . $search . '%')
            //             ->orWhereHas('user', function ($query) use ($search) {
            //                 $query->where('name', 'LIKE', '%' . $search . '%');
            //             })
            //             ->orWhereHas('signedBy', function ($query) use ($search) {
            //                 $query->where('name', 'LIKE', '%' . $search . '%');
            //             });
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

                    return view('profile.part-profile.time-management-part.assignment.components.request-menu', compact([
                        'query', 'statusEnum'
                    ]));
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
}
