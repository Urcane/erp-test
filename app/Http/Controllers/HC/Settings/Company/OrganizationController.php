<?php

namespace App\Http\Controllers\HC\Settings\Company;

use App\Exceptions\NotFoundError;
use App\Exceptions\InvariantError;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Department;
use App\Utils\ErrorHandler;

class OrganizationController extends Controller
{




    private function _loopChild($department) {
        $data = [];

        foreach ($department as $dep) {
            $childData = [];

            if ($dep->children != null) {
                $childData = $this->_loopChild($dep->children);
            }

            $data[] = [
                'name' => $dep->department_name,
                'count' => $dep->users->count() . " Karyawan",
                'children' => $childData
            ];
        }

        return $data;
    }

    public function index() {
        $dataOrganization = Department::all();

        $dataTree = $this->_loopChild($dataOrganization)[0];

        return view("hc.cmt-settings.company.organization.organization", compact(["dataOrganization", "dataTree"]));
    }

    public function getTableOrganization(Request $request) {
        if (request()->ajax()) {
            $query = Department::all();

            // dd($query);
            return DataTables::of($query)
            ->addColumn('action', function ($action) {
                $edit = '
                <li>
                    <div class="btn-edit" id="btn-'. $action->id . '">
                        <a href="#modal_create_organization" data-bs-toggle="modal" class="dropdown-item py-2"><i class="fa-solid fa-pen me-3"></i>Edit</a>
                    </div>
                </li>
                <script>
                    $("#btn-'. $action->id . '").click(function() {
                        $("[name=\'organization_id\']").val("'. $action->id .'")
                        $("[name=\'department_name\']").val("'. $action->department_name .'")
                        $("[name=\'department_alias\']").val("'. $action->department_alias .'")
                        $("[name=\'parent_id\'] option").each(function() {
                            if ($(this).val() == "'. $action->parent_id .'") {
                                $(this).prop("selected", true);
                            }
                        });
                    });
                </script>
                ';


                $delete = '<li><a href="#delete_confirmation_Organization" data-bs-toggle="modal" onclick="deleteOrganization(\'' . $action->id . '\')" class="dropdown-item py-2"><i class="fa-solid fa-trash me-3"></i>Delete</a></li>';
                return '
                <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <ul class="dropdown-menu">
                '.$edit.'
                '.$delete.'
                </ul>
                ';
            })
            ->addColumn('parent_name', function($Department) {
                return $Department->parent ? $Department->parent->department_name : "-";
            })
            ->addColumn('DT_RowChecklist', function($check) {
                return '<div class="text-center w-50px"><input name="family_ids" type="checkbox" value="'.$check->id.'"></div>';
            })
            ->addIndexColumn()
            ->rawColumns(['action','DT_RowChecklist'])
            ->make(true);
        }
    }

    public function createUpdate(Request $request) {
        try {
            $request->validate([
                "department_name" => "required",
                "department_alias" => "required",
                "parent_id" => "required",
            ]);

            Department::updateOrCreate([
                "id" => $request->organization_id,
            ], [
                "department_name" => $request->department_name,
                "department_alias" => $request->department_alias,
                "parent_id" => $request->parent_id,
            ]);

            return response()->json([
                'status' => "succes",
                'message' => "Data berhasil disimpan",
            ], 200);
        } catch (\Throwable $th) {

            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function delete(Request $request) {
        // dd("asdf");

        try {
            $department = Department::whereId($request->id)->first();
            if (!$department) {
                throw new NotFoundError("Data tidak ditemukan");
            }

            if ($department->children->first() || $department->users->first()) {
                throw new InvariantError("Departement masi memiliki bawahan");
            }

            if ($department->divisions->first()) {
                throw new InvariantError("Departement masi memiliki division");
            }

            Department::whereId($request->id)->delete();

            return response()->json([
                'status' => "succes",
                'message' => "Data berhasil dihapus",
            ], 200);
        } catch (\Throwable $th) {

            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
