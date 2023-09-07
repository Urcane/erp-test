<?php

namespace App\Http\Controllers\HC\Settings\Company;

use App\Exceptions\InvariantError;
use App\Exceptions\NotFoundError;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Division;
use App\Models\Department;

use App\Utils\ErrorHandler;

class JobPositionController extends Controller
{
    private $errorHandler;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
    }

    private function _loopChild($divisi)
    {
        $data = [];

        foreach ($divisi as $div) {
            $childData = [];

            if ($div->children != null) {
                $childData = $this->_loopChild($div->children);
            }

            $data[] = [
                'name' => $div->divisi_name,
                'count' => $div->users->count() . " Karyawan",
                'children' => $childData
            ];
        }

        return $data;
    }

    public function index()
    {
        $dataDivision = Division::all();
        $dataOrganization = Department::all();

        $dataTree = $this->_loopChild($dataDivision)[0];

        return view("hc.cmt-settings.company.job-position", compact(["dataDivision", "dataOrganization", "dataTree"]));
    }

    public function getTableJobPosition(Request $request)
    {
        if (request()->ajax()) {
            $query = Division::all();

            // dd($query);
            return DataTables::of($query)
                ->addColumn('action', function ($action) {
                    $edit = '
                <li>
                    <div class="btn-edit" id="btn-' . $action->id . '">
                        <a href="#modal_create_job_positon" data-bs-toggle="modal" class="dropdown-item py-2"><i class="fa-solid fa-pen me-3"></i>Edit</a>
                    </div>
                </li>
                <script>
                    $("#btn-' . $action->id . '").click(function() {
                        $("[name=\'id\']").val("' . $action->id . '")
                        $("[name=\'divisi_name\']").val("' . $action->department_name . '")
                        $("[name=\'divisi_alias\']").val("' . $action->department_alias . '")
                        $("[name=\'parent_id\'] option").each(function() {
                            if ($(this).val() == "' . $action->parent_id . '") {
                                $(this).prop("selected", true);
                            }
                        });
                        $("[name=\'department_id\'] option").each(function() {
                            if ($(this).val() == "' . $action->department_id . '") {
                                $(this).prop("selected", true);
                            }
                        });
                    });
                </script>
                ';

                    $delete = '<li><a href="#delete_confirmation_JobPosition" data-bs-toggle="modal" onclick="deleteJobPosition(\'' . $action->id . '\')" class="dropdown-item py-2"><i class="fa-solid fa-trash me-3"></i>Delete</a></li>';
                    return '
                <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <ul class="dropdown-menu">
                ' . $edit . '
                ' . $delete . '
                </ul>
                ';
                })
                ->addColumn('parent_name', function ($divisi) {
                    return $divisi->parent ? $divisi->parent->divisi_name : "-";
                })
                ->addColumn('employee', function ($divisi) {
                    return $divisi->users->count();
                })
                ->addColumn('DT_RowChecklist', function ($check) {
                    return '<div class="text-center w-50px"><input name="family_ids" type="checkbox" value="' . $check->id . '"></div>';
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'DT_RowChecklist'])
                ->make(true);
        }
    }

    public function createUpdate(Request $request)
    {
        try {
            $request->validate([
                "divisi_name" => "required",
                "divisi_alias" => "required",
                "department_id" => "required",
                "parent_id" => "required",
            ]);

            $subBranch = Division::updateOrCreate([
                "id" => $request->id,
            ], [
                "divisi_name" => $request->divisi_name,
                "divisi_alias" => $request->divisi_alias,
                "department_id" => $request->department_id,
                "parent_id" => $request->parent_id,
            ]);

            return response()->json([
                'status' => "succes",
                'message' => "Data berhasil disimpan",
            ], 200);
        } catch (\Throwable $th) {

            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $divisi = Division::whereId($request->id)->first();
            if (!$divisi) {
                throw new NotFoundError("Data tidak ditemukan");
            }

            if ($divisi->children->first() || $divisi->users->first()) {
                throw new InvariantError("Posisi masi memiliki bawahan");
            }

            $divisi->delete();

            return response()->json([
                'status' => "success",
                'message' => "Data berhasil dihapus",
            ], 200);
        } catch (\Throwable $th) {

            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
