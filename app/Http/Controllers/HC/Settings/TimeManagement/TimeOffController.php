<?php

namespace App\Http\Controllers\HC\Settings\TimeManagement;

use Illuminate\Http\Request;
use App\Models\Attendance\LeaveRequestCategory;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;

class TimeOffController extends TimeManagementController
{
    public function index()
    {
        return view("hc.cmt-settings.time-management.time-off");
    }

    public function getTable(Request $request)
    {
        if (request()->ajax()) {
            $query = LeaveRequestCategory::orderBy('created_at', 'desc');

            return DataTables::of($query)
                ->addColumn('action', function ($action) {
                    return "-";
                })
                ->addColumn('effective_date', function ($query) {
                    $date = Carbon::createFromFormat('Y-m-d', $query->effective_date);
                    $formattedDate = $date->format('d-m-Y');

                    return $formattedDate;
                })
                ->addColumn('expired_date', function ($query) {
                    $expiredDate = $query->expired_date;

                    if (!$expiredDate) {
                        return "Permanent";
                    }

                    $date = Carbon::createFromFormat('Y-m-d', $expiredDate);
                    $formattedDate = $date->format('d-m-Y');

                    return $formattedDate;
                })
                // ->addColumn('assigned_to', function($data) {
                //     $count = $data->users->count();
                //     return $count;
                // })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create(Request $request)
    {
        $balanceTypes = $this->constants->balance_type;

        return view("hc.cmt-settings.time-management.add-time-off", compact([
            'balanceTypes'
        ]));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:100|unique:leave_request_categories,name',
                'code' => 'required|string|max:8|unique:leave_request_categories,code',
                'effective_date' => 'required|date',
                'attachment' => 'nullable',
                'show_in_request' => 'nullable',
                'max_request' => 'integer|nullable|min:0|max:255',
                'use_quota' => 'nullable',
                'unlimited_balance' => 'boolean',

                // use balance
                'min_works' => 'nullable',
                'balance' => 'nullable',
                'balance_type' => [
                    'nullable',
                    Rule::in($this->constants->balance_type),
                    'required_if:unlimited_balance,false',
                ],
                'expired' => 'nullable',
                'carry_amount' => 'integer|nullable|min:0|max:255|required_if:expired,true',
                'carry_expired' => 'integer|nullable|min:0|max:255|required_if:expired,true',

                // use half day
                'half_day' => 'nullable',

                'minus_amount' => 'integer|nullable|min:0|max:255',
                'duration' => 'integer|nullable|min:0|max:255',
            ]);

            $data = [
                'name' => $request->name,
                'code' => $request->code,
                'effective_date' => $request->effective_date,
                'attachment' => $request->input('attachment', 0),
                'show_in_request' => $request->input('show_in_request', 0),
                'max_request' => $request->max_request,
                'use_quota' => $request->input('use_quota', 0),
                'unlimited_balance' => $request->input('unlimited_balance', 0),
            ];

            if (!$request->unlimited_balance) {
                $data += [
                    'min_works' => $request->min_works,
                    'balance' => $request->balance,
                    'balance_type' => $request->balance_type,
                    'expired' => $request->input('expired', 0),
                ];
            }

            if ($request->expired) {
                $data += [
                    'carry_amount' => $request->carry_amount,
                    'carry_expired' => $request->carry_expired,
                ];
            }

            if ($request->half_day) {
                $data += [
                    'half_day' => $request->half_day,
                ];
            } else {
                $data += [
                    'minus_amount' => $request->minus_amount,
                    'duration' => $request->duration,
                ];
            }

            LeaveRequestCategory::create($data);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil menambahkan Kategori Time Off"
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
