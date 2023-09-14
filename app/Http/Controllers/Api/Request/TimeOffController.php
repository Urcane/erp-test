<?php

namespace App\Http\Controllers\Api\Request;

use App\Exceptions\AuthorizationError;
use App\Exceptions\InvariantError;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Exceptions\NotFoundError;

use App\Models\Attendance\GlobalDayOff;
use App\Models\Leave\UserLeaveRequest;
use App\Models\Leave\LeaveRequestCategory;

use DateTime;
use DateInterval;
use DatePeriod;
use Illuminate\Support\Facades\Auth;

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

    public function getRequest(Request $request)
    {
        try {
            $page = $request->page ?? 1;
            $itemCount = $request->itemCount ?? 10;

            $userLeaveRequest = UserLeaveRequest::where('user_id', $request->user()->id)
                ->orderBy('created_at', 'desc')
                ->with(['approvalLine', 'leaveRequestCategory'])
                ->paginate($itemCount, ['*'], 'page', $page);

            return response()->json([
                "status" => "success",
                "data" => [
                    "currentPage" => $userLeaveRequest->currentPage(),
                    "itemCount" => $itemCount,
                    "userLeaveRequest" => $userLeaveRequest->items(),
                ],
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getRequestById(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required'
            ]);

            $userLeaveRequest = UserLeaveRequest::where('user_id', $request->user()->id)
                ->whereId($request->id)
                ->with('approvalLine')
                ->first();

            if (!$userLeaveRequest) {
                throw new NotFoundError("Request Tidak ditemukan");
            }

            return response()->json([
                "status" => "success",
                "data" => $userLeaveRequest
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function makeRequest(Request $request)
    {
        try {
            $request->validate([
                "start_date" => "required|date",
                "end_date" => "required|date|after_or_equal:start_date",
                "leave_request_category_id" => "required",
                "file" => "required",
                "notes" => "nullable|string"
            ]);

            Carbon::setLocale($this->constants->locale);

            $startDate = Carbon::parse($request->start_date);
            $endDate = Carbon::parse($request->end_date);

            $taken = 0;
            $workingDayOff = $request->user()->userEmployment->workingScheduleShift->workingSchedule->dayOffs()->pluck('day')->toArray();

            $holidayDates = $this->_getGlobalDayOff($startDate, $endDate);

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
                "user_id" => $request->user()->id,
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

    public function getCategories()
    {
        try {
            $timeOffCategories = LeaveRequestCategory::all();

            return response()->json([
                "status" => "success",
                "data" => $timeOffCategories
            ]);
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
}
