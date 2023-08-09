<?php

namespace App\Http\Controllers\Profile;

use DateTime;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Attendance\UserAttendanceRequest;
use App\Models\Attendance\UserShiftRequest;
use App\Models\Attendance\UserOvertimeRequest;
use App\Models\Attendance\UserLeaveRequest;

class TimeManagementController extends Controller
{
    public function getRequestAttendance(Request $request) {
        if (request()->ajax()) {
            $query = UserAttendanceRequest::where('user_id',$request->user_id)
            ->orderBy('id','DESC');

            $query = $query->get();
            return DataTables::of($query)
            ->addColumn('action', function ($action) {
                $mnue = '<li><a href="'.route('hc.emp.profile',['id'=>$action->id]).'" class="dropdown-item py-2"><i class="fa-solid fa-id-badge me-3"></i>Profile</a></li>';
                return '
                <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <ul class="dropdown-menu">
                '.$mnue.'
                </ul>
                ';
            })
            ->addColumn('approved_by', function ($requestAttendance) {
                $data = $requestAttendance->approvedBy->name;
                return $data;
            })
            ->addColumn('check_in', function ($time) {
                $data = explode(" ", $time->check_in)[1];
                return $data;
            })
            ->addColumn('check_out', function ($time) {
                $data = explode(" ", $time->check_out)[1];
                return $data;
            })

            ->addIndexColumn()
            ->rawColumns(['action','DT_RowChecklist'])
            ->make(true);
        }
    }

    public function getRequestShift(Request $request) {
        if (request()->ajax()) {
            $query = UserShiftRequest::where('user_id',$request->user_id)
            ->orderBy('id','DESC');

            $query = $query->get();
            return DataTables::of($query)
            ->addColumn('action', function ($action) {
                $mnue = '<li><a href="'.route('hc.emp.profile',['id'=>$action->id]).'" class="dropdown-item py-2"><i class="fa-solid fa-id-badge me-3"></i>Profile</a></li>';
                return '
                <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <ul class="dropdown-menu">
                '.$mnue.'
                </ul>
                ';
            })
            ->addColumn('approved_by', function ($requestShift) {
                $data = $requestShift->approvedBy->name;
                return $data;
            })
            ->addColumn('shift', function ($requestShift) {
                $data = $requestShift->workingShift->name;
                return $data;
            })
            ->addColumn('working_start', function ($requestShift) {
                $data = $requestShift->workingShift->working_start;
                return $data;
            })
            ->addColumn('working_end', function ($requestShift) {
                $data = $requestShift->workingShift->working_end;
                return $data;
            })

            ->addIndexColumn()
            ->rawColumns(['action','DT_RowChecklist'])
            ->make(true);
        }
    }

    public function getRequestOvertime(Request $request) {
        if (request()->ajax()) {
            $query = UserOvertimeRequest::where('user_id',$request->user_id)
            ->orderBy('id','DESC');

            $query = $query->get();
            return DataTables::of($query)
            ->addColumn('action', function ($action) {
                $mnue = '<li><a href="'.route('hc.emp.profile',['id'=>$action->id]).'" class="dropdown-item py-2"><i class="fa-solid fa-id-badge me-3"></i>Profile</a></li>';
                return '
                <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <ul class="dropdown-menu">
                '.$mnue.'
                </ul>
                ';
            })
            ->addColumn('created_at', function ($requestOvertime) {
                $data = explode(" ", explode("T", $requestOvertime->created_at)[0])[0];
                return $data;
            })
            ->addColumn('approved_by', function ($requestOvertime) {
                $data = $requestOvertime->approvedBy->name;
                return $data;
            })

            ->addIndexColumn()
            ->rawColumns(['action','DT_RowChecklist'])
            ->make(true);
        }
    }

    public function getRequestTimeOf(Request $request) {
        if (request()->ajax()) {
            $query = UserLeaveRequest::where('user_id',$request->user_id)
            ->orderBy('id','DESC');

            $query = $query->get();
            return DataTables::of($query)
            ->addColumn('action', function ($action) {
                $mnue = '<li><a href="'.route('hc.emp.profile',['id'=>$action->id]).'" class="dropdown-item py-2"><i class="fa-solid fa-id-badge me-3"></i>Profile</a></li>';
                return '
                <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <ul class="dropdown-menu">
                '.$mnue.'
                </ul>
                ';
            })
            ->addColumn('created_at', function ($requestTimeOf) {
                $data = explode(" ", explode("T", $requestTimeOf->created_at)[0])[0];
                return $data;
            })
            ->addColumn('taken', function ($requestTimeOf) {
                $date1 = new DateTime($requestTimeOf->start_date);
                $date2 = new DateTime($requestTimeOf->end_date);
                $interval = $date1->diff($date2);

                $data = $interval->d . " days ";
                return $data;
            })

            ->addIndexColumn()
            ->rawColumns(['action','DT_RowChecklist'])
            ->make(true);
        }
    }
}
