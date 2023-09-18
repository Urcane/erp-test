<?php

namespace App\Http\Controllers\Request;

use App\Exceptions\AuthorizationError;
use App\Exceptions\InvariantError;
use App\Exceptions\NotFoundError;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Yajra\DataTables\DataTables;

use App\Models\Attendance\GlobalDayOff;
use App\Models\Leave\LeaveRequestCategory;
use App\Models\Leave\UserLeaveCategoryQuota;
use App\Models\Leave\UserLeaveRequest;
use Carbon\Carbon;

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

    private function _getTakenDays($startDate, $endDate)
    {
        Carbon::setLocale($this->constants->locale);

        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);

        $taken = 0;
        $workingDayOff = Auth::user()->userEmployment->workingScheduleShift->workingSchedule->dayOffs->pluck('day')->toArray();

        $holidayDates = $this->_getGlobalDayOff($startDate, $endDate);

        while ($startDate <= $endDate) {
            $currentDate = $startDate->copy();
            $dayName = $currentDate->translatedFormat('l');

            if (!in_array($currentDate->toDateString(), $holidayDates) && !in_array($dayName, $workingDayOff)) {
                $taken += 1;
            }

            $startDate->addDay();
        }

        return $taken;
    }

    public function makeRequest(Request $request)
    {
        try {
            $request->validate([
                "start_date" => "required|date",
                "end_date" => "required|date|after:start_date",
                "leave_request_category_id" => "required",
                "file" => "required",
                "notes" => "nullable|string"
            ]);

            $user = Auth::user();
            $today = Carbon::now()->format('Y-m-d');

            $query = [
                "user_leave_category_quotas" => null,
            ];

            $leaveCategory = LeaveRequestCategory::whereId($request->leave_request_category_id)->first();

            if (!$leaveCategory) {
                throw new NotFoundError("Kategori Request Tidak ditemukan");
            }

            if ($leaveCategory->attachment && !$request->file) {
                throw new InvariantError("Attachment Required!");
            }

            if (!$user->userEmployment) {
                throw new InvariantError("Anda tidak memiliki data pegawai");
            }

            $requestDuration = Carbon::parse($request->start_date)->diffInDays(Carbon::parse($request->end_date)) + 1;

            if (!$leaveCategory->unlimited_balance) {
                $balanceTaken = 0;

                if ($leaveCategory->expire_date) {
                    $userCategoryQuota = UserLeaveCategoryQuota::where("leave_request_category_id", $leaveCategory->id)
                        ->where("user_id", $user->id)
                        ->orderBy("expire_date", "asc")
                        ->first();

                    if ($userCategoryQuota) {
                        if ($leaveCategory->duration) {
                            if ($leaveCategory->minus_amount) {
                                $balanceTaken = $leaveCategory->minus_amount;
                            } else {
                                $balanceTaken = $leaveCategory->duration;
                            }
                        } else {
                            $balanceTaken = $this->_getTakenDays($request->start_date, $request->end_date);
                        }

                        if ($userCategoryQuota->expire_date > $today) {
                            if ($leaveCategory->balance_type == $this->constants->balance_type[0]) {
                                $expireDate = Carbon::parse($userCategoryQuota->expire_date)->addMonths(12);
                            } else {
                                $expireDate = Carbon::parse($userCategoryQuota->expire_date)->addMonth();
                            }

                            if ($leaveCategory->carry_amount && $userCategoryQuota->quotas > 0) {
                                $carryExpireDate = Carbon::parse($userCategoryQuota->expire_date)->addMonth($leaveCategory->carry_expired);
                                $carryAmount = ($userCategoryQuota->quotas <= $leaveCategory->carry_amount)
                                    ? $userCategoryQuota->quotas : $leaveCategory->carry_amount;

                                UserLeaveCategoryQuota::create([
                                    "user_id" => $user->id,
                                    "leave_request_category_id" => $leaveCategory->id,
                                    "quotas" => $leaveCategory->balance,
                                    "expired_date" => $expireDate,
                                    "carry_quotas" => $carryAmount,
                                    "carry_expired" => $carryExpireDate
                                ]);

                                if ($leaveCategory->balance + $carryAmount < $balanceTaken) {
                                    throw new InvariantError("Kuota $leaveCategory->name anda tidak mencukupi!");
                                }

                                if ($carryAmount > $balanceTaken) {
                                    $query["user_leave_category_quotas"] = [
                                        "carry_quotas" => $carryAmount - $balanceTaken
                                    ];
                                } else if ($carryAmount = $balanceTaken) {
                                    $query["user_leave_category_quotas"] = [
                                        "carry_quotas" => 0
                                    ];
                                } else {
                                    $query["user_leave_category_quotas"] = [
                                        "quotas" => $leaveCategory->balance - ($balanceTaken - $carryAmount),
                                        "carry_quotas" => 0
                                    ];
                                }
                            } else {
                                $userCategoryQuota = UserLeaveCategoryQuota::create([
                                    "user_id" => $user->id,
                                    "leave_request_category_id" => $leaveCategory->id,
                                    "quotas" => $leaveCategory->balance,
                                    "expired_date" => $expireDate,
                                ]);

                                if ($leaveCategory->balance < $balanceTaken) {
                                    throw new InvariantError("Kuota $leaveCategory->name anda tidak mencukupi!");
                                }

                                $query["user_leave_category_quotas"] = [
                                    "quotas" => $leaveCategory->balance - $balanceTaken,
                                ];
                            }
                        } else {
                            if ($userCategoryQuota->carry_quotas && $userCategoryQuota->carry_quotas > 0) {
                                if ($userCategoryQuota->quotas + $userCategoryQuota->carry_quotas < $balanceTaken) {
                                    throw new InvariantError("Kuota $leaveCategory->name anda tidak mencukupi!");
                                }

                                if ($userCategoryQuota->carry_quotas > $balanceTaken) {
                                    $query["user_leave_category_quotas"] = [
                                        "carry_quotas" => $userCategoryQuota->carry_quotas - $balanceTaken
                                    ];
                                } else if ($carryAmount = $balanceTaken) {
                                    $query["user_leave_category_quotas"] = [
                                        "carry_quotas" => 0
                                    ];
                                } else {
                                    $query["user_leave_category_quotas"] = [
                                        "quotas" => $leaveCategory->balance - ($balanceTaken - $carryAmount),
                                        "carry_quotas" => 0
                                    ];
                                }
                            } else {
                                if ($userCategoryQuota->quotas < $balanceTaken) {
                                    throw new InvariantError("Kuota $leaveCategory->name anda tidak mencukupi!");
                                }
                            }
                        }
                    } else {
                        if (
                            Carbon::parse($user->userEmployment->join_date)
                                ->addMonths($leaveCategory->min_works)
                                ->gt($today)
                        ) {
                            throw new InvariantError("Anda tidak memiliki kuota $leaveCategory->name!");
                        }
                    }
                } else {


                    // if ($leaveCategory->duration) {
                    //     if ($leaveCategory->minus_amount) {

                    //     } else {

                    //     }
                    // } else {

                    // }
                }
            }

            if ($leaveCategory->half_day) {
                if ($leaveCategory->use_quota) {

                } else {

                }
            } else {
                if ($leaveCategory->use_quota) {
                    if ($leaveCategory->duration) {
                        if ($leaveCategory->minus_amount) {

                        } else {

                        }
                    } else {

                    }
                } else {
                    if ($leaveCategory->duration) {

                    } else {

                    }
                }
            }



            if ($request->file) {
                $file = $request->file('file');
                $filename = time() . $file->getClientOriginalName();
                $file->storeAs('request/timeoff/', $filename, 'public');
            }

            $taken = $this->_getTakenDays($request->start_date, $request->end_date);

            UserLeaveRequest::create([
                "user_id" => Auth::user()->id,
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

    public function showRequestTableById(Request $request)
    {
        if (request()->ajax()) {
            /** @var App\Models\User $user */
            $user = Auth::user();
            if (!($user->id == $request->user_id|| $user->hasPermissionTo('HC:view-attendance'))) {
                abort(403);
            }

            $leaveRequest = UserLeaveRequest::where('user_id', $request->user_id)
                ->orderBy('created_at', 'desc')
                ->with(['user.userEmployment', 'approvalLine', 'leaveRequestCategory']);

            return DataTables::of($leaveRequest)
                ->addColumn('action', function ($query) {
                    $constants = $this->constants;

                    $fileName = $query->file;
                    $fileLink = asset("/storage/request/timeoff/$fileName");
                    return view('profile.part-profile.time-management-part.timeoff.menu', compact([
                        'query', 'constants', 'fileName', 'fileLink'
                    ]));
                })
                ->addColumn('created_at', function ($leaveRequest) {
                    $date = explode(" ", explode("T", $leaveRequest->created_at)[0])[0];

                    $date = Carbon::createFromFormat('Y-m-d', $date);
                    $formattedDate = $date->format('d-m-Y');

                    return $formattedDate;
                })
                ->addColumn('approval_line', function ($leaveRequest) {
                    if ($leaveRequest->status != $this->constants->approve_status[0]) {
                        return $leaveRequest->approvalLine->name ?? "-";
                    }

                    return $leaveRequest->user->userEmployment->approvalLine->name ?? "-";
                })
                ->addColumn('taken', function ($leaveRequest) {
                    return "$leaveRequest->taken Day(s)";
                })
                ->addColumn('code', function ($leaveRequest) {
                    return $leaveRequest->leaveRequestCategory->code;
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'DT_RowChecklist'])
                ->make(true);
        }
    }
}
