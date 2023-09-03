<?php

namespace App\Http\Controllers\HC\Settings\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Employee\EmploymentStatus;

class EmploymentStatusController extends Controller
{
    public function index() {
        $dataEmploymentStatus = EmploymentStatus::all();

        return view("hc.cmt-settings.company.employee-status", compact(["dataEmploymentStatus"]));
    }

    public function getTableEmploymentStatus(Request $request) {
        if (request()->ajax()) {
            $query = EmploymentStatus::all();

            // dd($query);
            return DataTables::of($query)
            ->addColumn('action', function ($action) {
                $edit = '
                <li>
                    <div class="btn-edit" id="btn-'. $action->id . '">
                        <a href="#modal_create_employment_status" data-bs-toggle="modal" class="dropdown-item py-2"><i class="fa-solid fa-pen me-3"></i>Edit</a>
                    </div>
                </li>
                <script>
                    $("#btn-'. $action->id . '").click(function() {
                        $("[name=\'id\']").val("'. $action->id .'")
                        $("[name=\'have_end_date\'] option").each(function() {
                            if ($(this).val() == "'. $action->have_end_date .'") {
                                $(this).prop("selected", true);
                            }
                        });
                        $("[name=\'name\']").val("'. $action->name .'")
                    });
                </script>
                ';


                $delete = '<li><button onclick="deleteJobLevel(\'' . $action->id . '\')" class="dropdown-item py-2"><i class="fa-solid fa-trash me-3"></i>Delete</button></li>';
                return '
                <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <ul class="dropdown-menu">
                '.$edit.'
                '.$delete.'
                </ul>
                ';
            })
            ->addColumn('DT_RowChecklist', function($check) {
                return '<div class="text-center w-50px"><input name="job_level_ids" type="checkbox" value="'.$check->id.'"></div>';
            })
            ->addColumn('have_end_date', function($status) {
                return $status->have_end_date == "1" ? "Yes" : "No";
            })
            ->addIndexColumn()
            ->rawColumns(['action','DT_RowChecklist'])
            ->make(true);
        }
    }

    public function createUpdate(Request $request) {
        $request->validate([
            "name" => "required",
        ]);

        EmploymentStatus::updateOrCreate([
            "id" => $request->id,
        ], [
            'name' => $request->name,
            'have_end_date' => $request->have_end_date
        ]);

        return response()->json([
            'status' => "succes",
            'message' => "Data berhasil disimpan",
        ], 200);;
    }

    public function delete(Request $request) {

        EmploymentStatus::whereId($request->id)->delete();

        return response()->json([
            'status' => "succes",
            'message' => "Data berhasil dihapus",
        ], 200);
    }
}
