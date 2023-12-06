<?php

namespace App\Http\Controllers\Api\Request;

use App\Constants;
use App\Exceptions\AuthorizationError;
use App\Exceptions\InvariantError;
use App\Exceptions\NotFoundError;
use App\Http\Controllers\Controller;
use App\Models\Assignment\Assignment;
use App\Models\User;
use App\Utils\ErrorHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AssignmentController extends Controller
{
    private $constants;

    public function __construct()
    {
        $this->constants = new Constants();
    }

    public function create(Request $request)
    {
        $users = User::where('department_id', $request->user()->department_id)
            ->has('userEmployment')->has('division')
            ->with(['userEmployment', 'division'])
            ->get();

        $days = $this->constants->day;

        return response()->json([
            "status" => "success",
            "data" => [
                "users" => $users,
                "days" => $days
            ]
        ]);
    }

    public function getDetail(Request $request, string $id)
    {
        $assignment = Assignment::whereId($id)->first();

        if (!$assignment) {
            throw new NotFoundError("Penugasan Tidak ditemukan");
        }

        if ($assignment->status != $this->constants->assignment_status[0]) {
            throw new InvariantError("Penugasan Belum disetujui");
        }

        if ($assignment->user_id != $request->user()->id) {
            throw new AuthorizationError("Anda tidak berhak mengakses resource ini");
        }

        $users = User::where('department_id', $request->user()->department_id)
            ->where('id', '!=', $request->user()->id)
            ->has('userEmployment')->has('division')
            ->with(['userEmployment', 'division'])
            ->get();

        $days = $this->constants->day;

        return response()->json([
            "status" => "success",
            "data" => [
                "users" => $users,
                "days" => $days,
                "assignment" => $assignment
            ]
        ]);
    }

    public function update(Request $request)
    {
        try {
            $assignment = Assignment::whereId($request->id)->first();

            if (!$assignment) {
                throw new NotFoundError("Penugasan tidak ditemukan");
            }

            if ($assignment->user_id != $request->user()->id) {
                throw new AuthorizationError("Anda tidak berhak mengubah penugasan ini");
            }

            if ($assignment->status != $this->constants->assignment_status[0]) {
                throw new InvariantError("Tidak dapat mengubah penugasan, Penugasan sudah $assignment->status");
            }

            $request->validate([
                'number' => ['required', 'string', 'max:255', Rule::unique('assignments')->ignore($assignment->id)],
                'signed_by' => 'required|exists:users,id',
                'start_date' => 'required|date|after_or_equal:today',
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

    public function store(Request $request)
    {
        try {
            $request->validate([
                'number' => 'required|string|max:255|unique:assignments',
                'signed_by' => 'required|exists:users,id',
                'start_date' => 'required|date|after_or_equal:today',
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
                "user_id" => $request->user()->id,
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
                "user_id" => $request->user()->id,
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

    public function cancelRequest(Request $request)
    {
        try {
            $assignment = Assignment::whereId($request->id)->first();

            if (!$assignment) {
                throw new NotFoundError("Penugasan tidak ditemukan");
            }

            if ($assignment->user_id != $request->user()->id) {
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
        try {
            $user = $request->user();

            if (!($user->id == $request->user_id || $user->hasPermissionTo('HC:view-attendance'))) {
                throw new AuthorizationError("Anda tidak berhak mengakses resource ini");
            }

            $assignments = Assignment::whereHas('userAssignments', function ($query) use ($request) {
                $query->where('user_id', $request->user_id);
            })->where('status', $this->constants->assignment_status[1])
                ->orderBy('created_at', 'desc')
                ->with(['user', 'signedBy', 'userAssignments'])
                ->get();

            return response()->json([
                "status" => "success",
                "data" => $assignments
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function showOwnRequest(Request $request)
    {
        try {
            $user = $request->user();

            if (!($user->id == $request->user_id || $user->hasPermissionTo('HC:view-attendance'))) {
                throw new AuthorizationError("Anda tidak berhak mengakses resource ini");
            }

            $assignments = Assignment::where('user_id', $request->user_id)
                ->orderByRaw(
                    "FIELD(status, ?, ?, ?, ?, ?)",
                    $this->constants->assignment_status
                )
                ->with(['user', 'signedBy', 'userAssignments']);

            return response()->json([
                "status" => "success",
                "data" => $assignments
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function exportPdf(Request $request, string $assignmentId, string $userId)
    {
        $assignment = Assignment::whereId($assignmentId)->first();

        if (!$assignment) {
            throw new NotFoundError("Penugasan Tidak ditemukan");
        }

        if ($assignment->status != $this->constants->assignment_status[1]) {
            throw new NotFoundError("Penugasan Tidak ditemukan");
        }

        $userAssignment = $assignment->userAssignments()->whereId($userId)->first();

        if (!$userAssignment) {
            throw new NotFoundError("Penugasan Tidak ditemukan");
        }

        $authUser = $request->user();

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

        return view('operation.assignment.pdf', compact([
            'assignment', 'user', 'signed'
        ]));
    }
}
