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
use App\Utils\RomanNumber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AssignmentController extends Controller
{
    private $constants;

    public function __construct()
    {
        $this->constants = new Constants();
    }

    private function getAssignmentNumber()
    {
        $lastAssignment = Assignment::whereHas('user', function ($query) {
            $query->where('department_id', Auth::user()->department_id);
        })
            ->whereBetween('created_at', [
                Carbon::now()->startOfMonth()->toDateTimeString(),
                Carbon::now()->endOfMonth()->toDateTimeString(),
            ])
            ->orderBy('created_at', 'desc')
            ->first();

        $numericMonth = Carbon::now()->format('m');
        $romanMonth = RomanNumber::convertToRoman($numericMonth);

        $department = Auth::user()->department->department_alias;

        if (!$lastAssignment) {
            return "001/{$department}/{$romanMonth}/" . Carbon::now()->format('Y');
        }

        $lastAssignmentNumber = intval(explode('/', $lastAssignment->number)[0]) + 1;

        $threeDigitNumber = str_pad($lastAssignmentNumber, 3, '0', STR_PAD_LEFT);

        return "{$threeDigitNumber}/{$department}/{$romanMonth}/" . Carbon::now()->format('Y');
    }

    public function create(Request $request)
    {
        try {
            // $users = User::where('department_id', $request->user()->department_id)
            //     ->has('userEmployment')->has('division')
            //     ->with(['userEmployment', 'division'])
            //     ->get();

            $days = $this->constants->day;

            return response()->json([
                "status" => "success",
                "data" => [
                    "users" => [$request->user()->userEmployment->approvalLine],
                    "days" => $days
                ]
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getDetail(Request $request, string $id)
    {
        try {
            $assignment = Assignment::whereId($id)->with([
                'signedBy', 'userAssignments.user', 'userAssignments.user.userEmployment', 'userAssignments.user.division'
            ])->first();

            if (!$assignment) {
                throw new NotFoundError("Penugasan Tidak ditemukan");
            }

            $authUser = $request->user();

            if ($authUser->id !== $assignment->user_id) {
                if (
                    !$assignment->userAssignments->contains('user_id', $authUser->id) ||
                    $assignment->status != $this->constants->assignment_status[1]
                ) {
                    throw new AuthorizationError("Anda tidak berhak mengakses resource ini");
                }
            }

            $days = $this->constants->day;
            $statusEnum = $this->constants->assignment_status;

            return response()->json([
                "status" => "success",
                "data" => [
                    "status" => $statusEnum,
                    "days" => $days,
                    "assignment" => $assignment
                ]
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
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
                "number" => $this->getAssignmentNumber(),
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
            $page = $request->page ?? 1;
            $itemCount = $request->itemCount ?? 10;

            if (!($user->id == $request->user_id || $user->hasPermissionTo('HC:view-attendance'))) {
                throw new AuthorizationError("Anda tidak berhak mengakses resource ini");
            }

            $assignments = Assignment::whereHas('userAssignments', function ($query) use ($request) {
                $query->where('user_id', $request->user_id);
            })->where('status', $this->constants->assignment_status[1])
                ->orderBy('created_at', 'desc')
                ->with(['user', 'signedBy', 'userAssignments'])
                ->paginate($itemCount, ['*'], 'page', $page);

            return response()->json([
                "status" => "success",
                "data" => [
                    "assignments" => $assignments->items(),
                    "currentPage" => $assignments->currentPage(),
                    "itemCount" => $itemCount,
                ]
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
            $page = $request->page ?? 1;
            $itemCount = $request->itemCount ?? 10;

            if (!($user->id == $request->user_id || $user->hasPermissionTo('HC:view-attendance'))) {
                throw new AuthorizationError("Anda tidak berhak mengakses resource ini");
            }

            $assignments = Assignment::where('user_id', $request->user()->id)
                ->orderByRaw(
                    "FIELD(status, ?, ?, ?, ?, ?)",
                    $this->constants->assignment_status
                )
                ->with(['user', 'signedBy', 'userAssignments'])
                ->paginate($itemCount, ['*'], 'page', $page);

            return response()->json([
                "status" => "success",
                "data" => [
                    "assignments" => $assignments->items(),
                    "currentPage" => $assignments->currentPage(),
                    "itemCount" => $itemCount,
                ]
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function exportPdf(Request $request, string $assignmentId, string $userId)
    {
        try {
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
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
