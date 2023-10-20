<?php

namespace App\Http\Controllers\HC\Settings\TimeManagement;

use App\Exceptions\NotFoundError;
use Illuminate\Http\Request;
use App\Models\Leave\LeaveRequestCategory;
use App\Utils\ErrorHandler;
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
                    $mnue = '<li><a href="' . route('hc.setting.timeoff.edit', ['id' => $action->id]) . '" class="dropdown-item py-2"><i class="fa-solid fa-pencil me-3"></i>Edit</a></li>';
                    return '
                        <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                        <ul class="dropdown-menu">
                        ' . $mnue . '
                        </ul>
                    ';
                })
                ->addColumn('effective_date', function ($query) {
                    $date = Carbon::createFromFormat('Y-m-d', $query->effective_date);
                    $formattedDate = $date->format('d-m-Y');

                    return $formattedDate;
                })
                ->addColumn('show_in_request', function ($query) {
                    if ($query->show_in_request) {
                        return '<div class="d-inline-flex justify-content-center align-items-center bg-success rounded-circle"
                        style="width: 20px; height: 20px;">
                        <i class="fas fa-check text-white"></i>
                    </div>';
                    }
                    return '<div class="d-inline-flex justify-content-center align-items-center bg-danger rounded-circle"
                    style="width: 20px; height: 20px;">
                    <i class="fas fa-times text-white"></i>
                </div>';
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'show_in_request'])
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
                'unlimited_balance' => 'nullable',

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
                'attachment' => (bool) $request->attachment,
                'show_in_request' => (bool) $request->show_in_request,
                'max_request' => $request->max_request,
                'use_quota' => (bool) $request->use_quota,
                'unlimited_balance' => (bool) $request->unlimited_balance,
            ];

            if (!$request->unlimited_balance) {
                $data += [
                    'min_works' => $request->min_works,
                    'balance' => $request->balance,
                    'balance_type' => $request->balance_type,
                    'expired' => (bool) $request->expire,
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
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function edit(String $id)
    {
        $category = LeaveRequestCategory::findOrFail($id);
        $balanceTypes = $this->constants->balance_type;

        return view('hc.cmt-settings.time-management.edit-time-off', compact([
            'category', 'balanceTypes'
        ]));
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required',
                'name' => 'required|string|max:100',
                'code' => 'required|string|max:8',
                'effective_date' => 'required|date',
                'attachment' => 'nullable',
                'show_in_request' => 'nullable',
                'max_request' => 'integer|nullable|min:0|max:255',
                'use_quota' => 'nullable',
                'unlimited_balance' => 'nullable',

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

            $leaveCategory = LeaveRequestCategory::whereId($request->id)->first();

            if (!$leaveCategory) {
                throw new NotFoundError("Kategori Time Off tidak ditemukan");
            }

            $data = [
                'name' => $request->name,
                'code' => $request->code,
                'effective_date' => $request->effective_date,
                'attachment' => (bool) $request->attachment,
                'show_in_request' => (bool) $request->show_in_request,
                'max_request' => $request->max_request,
                'use_quota' => (bool) $request->use_quota,
                'unlimited_balance' => (bool) $request->unlimited_balance,
            ];

            if (!$request->unlimited_balance) {
                $data += [
                    'min_works' => $request->min_works,
                    'balance' => $request->balance,
                    'balance_type' => $request->balance_type,
                    'expired' => (bool) $request->expire,
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

            $leaveCategory->update($data);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil melakukan update Kategori $leaveCategory->name Time Off"
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
