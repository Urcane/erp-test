<?php

namespace App\Http\Controllers\Api\Request;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Exceptions\NotFoundError;

use App\Models\Attendance\GlobalDayOff;
use App\Models\Attendance\UserLeaveRequest;
use App\Models\Attendance\LeaveRequestCategory;

class TimeOffController extends RequestController
{
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
            $workingDayOff = $request->user()->userEmployment->workingScheduleShift->workingSchedule->dayOffs()->pluck('name')->toArray();
            $holidayDates = GlobalDayOff::whereBetween('date', [$startDate, $endDate])->pluck('date')->toArray();

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

    public function getRequestCategory()
    {
        try {
            $leaveRequestCategories = LeaveRequestCategory::all();
            return response()->json([
                "status" => "success",
                "data" => $leaveRequestCategories,
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
