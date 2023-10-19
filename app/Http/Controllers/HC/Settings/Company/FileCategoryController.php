<?php

namespace App\Http\Controllers\HC\Settings\Company;

use App\Exceptions\InvariantError;
use App\Exceptions\NotFoundError;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use App\Models\PersonalInfo\UserFileCategory;
use App\Utils\ErrorHandler;

class FileCategoryController extends Controller
{




    public function index()
    {
        $dataUserFileCategory = UserFileCategory::all();

        return view("hc.cmt-settings.company.files-category", compact(["dataUserFileCategory"]));
    }

    public function getTableUserFileCategory(Request $request)
    {
        if (request()->ajax()) {
            $query = UserFileCategory::all();

            // dd($query);
            return DataTables::of($query)
                ->addColumn('action', function ($action) {
                    $edit = '
                <li>
                    <div class="btn-edit" id="btn-' . $action->id . '">
                        <a href="#file_category" data-bs-toggle="modal" class="dropdown-item py-2"><i class="fa-solid fa-pen me-3"></i>Edit</a>
                    </div>
                </li>
                <script>
                    $("#btn-' . $action->id . '").click(function() {
                        $("[name=\'id\']").val("' . $action->id . '")
                        $("[name=\'name\']").val("' . $action->name . '")
                    });
                </script>
                ';

                    $delete = '<li><a href="#delete_confirmation_FileCategory" data-bs-toggle="modal" onclick="deleteFileCategory(\'' . $action->id . '\')" class="dropdown-item py-2"><i class="fa-solid fa-trash me-3"></i>Delete</a></li>';
                    return '
                <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <ul class="dropdown-menu">
                ' . $edit . '
                ' . $delete . '
                </ul>
                ';
                })
                ->addColumn('DT_RowChecklist', function ($check) {
                    return '<div class="text-center w-50px"><input name="job_level_ids" type="checkbox" value="' . $check->id . '"></div>';
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
                "name" => "required",
            ]);

            UserFileCategory::updateOrCreate([
                "id" => $request->id,
            ], [
                'name' => $request->name
            ]);

            return response()->json([
                'status' => "success",
                'message' => "Data berhasil disimpan",
            ], 200);
        } catch (\Throwable $th) {

            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $file = UserFileCategory::whereId($request->id)->first();
            if (!$file) {
                throw new NotFoundError("Data tidak ditemukan");
            }

            if ($file->userFiles->first()) {
                throw new InvariantError("Kategori masih digunakan oleh file");
            }

            $file->delete();


            return response()->json([
                'status' => "success",
                'message' => "Data berhasil dihapus",
            ], 200);
        } catch (\Throwable $th) {

            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
