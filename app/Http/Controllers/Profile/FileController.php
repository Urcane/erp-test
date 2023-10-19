<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Utils\ErrorHandler;
use App\Exceptions\InvariantError;
use App\Exceptions\NotFoundError;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

Use App\Models\PersonalInfo\UserFile;
Use App\Models\PersonalInfo\UserFileCategory;
use Carbon\Carbon;

class FileController extends Controller
{




    public function getTableUserFile(Request $request) {
        if (request()->ajax()) {
            $query = UserFile::where('user_id',$request->user_id)
            ->orderBy('user_files.id','DESC');

            $query = $query->get();
            return DataTables::of($query)
            ->addColumn('action', function ($action) {
                $edit = '
                <li>
                    <div class="btn-edit" onclick="fillInput(\'' . $action->id . '\', \'' . $action->user_file_category_id . '\', \'' . $action->description . '\')">
                        <a href="#modal_user_file" data-bs-toggle="modal" class="dropdown-item py-2"><i class="fa-solid fa-pen me-3"></i>Edit</a>
                    </div>
                </li>

                ';
                $delete = '<li><button onclick="deleteUserFile(\'' . $action->id . '\')" class="dropdown-item py-2"><i class="fa-solid fa-trash me-3"></i>Delete</button></li>';
                return '
                <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <ul class="dropdown-menu">
                '.$edit.'
                '.$delete.'
                </ul>
                ';
            })
            ->addColumn('category', function ($data) {
                return $data->userFileCategory->name;
            })
            ->addColumn('file', function ($data) {
                $id = $data->id;
                return view('profile.part-profile.components.download-button', compact(["id"]));
            })
            ->addColumn('created_at', function ($data) {
                $date = explode(" ", explode("T", $data->created_at)[0])[0];

                $date = Carbon::createFromFormat('Y-m-d', $date);
                $formattedDate = $date->format('d-m-Y');

                return $formattedDate;
            })
            ->addIndexColumn()
            ->rawColumns(['action','DT_RowChecklist'])
            ->make(true);
        }
    }

    public function createUpdateUserFile(Request $request) {
        try {
            $request->validate([
                'user_id' => 'required',
                'category_id' => 'required',
                'description' => 'required',
                'file' => "required",
            ]);

            $file = $request->file('file');
            $filename = time() . $request->user_id  . "_" . UserFileCategory::whereId($request->category_id)->first()->name . '.' .  $file->extension();

            $checkDataInDb = UserFile::whereId($request->id)->first();
            if ($checkDataInDb) {
                $filename = $checkDataInDb->file;
            }

            $UserFile = UserFile::updateOrCreate(
            [
                "id" => $request->id,
            ], [
                "user_id" => $request->user_id,
                'user_file_category_id' => $request->category_id,
                'description' => $request->description,
                'file' => $filename,
            ]);

            $file->storeAs('personal/file', $filename, 'public');

            $UserFile->update(['file' => $filename,]);

            return response()->json([
                'status' => "succes",
                'message' => "Data berhasil disimpan",
            ], 200);
        } catch (\Throwable $th) {

            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function deleteUserFile(Request $request) {
        try {
            $UserFile = UserFile::whereId($request->id)->first();
            Storage::delete('public/personal/file/'.$UserFile->file);

            $UserFile->delete();

            return response()->json([
                'status' => "succes",
                'message' => "Data berhasil dihapus",
            ], 200);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function download(Request $request) {
        try {
            $file = UserFile::whereId($request->id)->get()[0]->file;

            return Storage::download('public/personal/file/' . $file);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
