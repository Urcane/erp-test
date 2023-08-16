<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\PersonalInfo\UserFile;

class FileContolller extends Controller
{
    public function getTableUserFile(Request $request) {
        if (request()->ajax()) {
            $query = DB::table('user_files')
            ->where('user_id',$request->user_id)
            ->orderBy('id','DESC');

            $query = $query->get();
            return DataTables::of($query)
            ->addColumn('action', function ($action) {
                $edit = '
                <li>
                    <div class="btn-edit" id="btn-non-'. $action->id . '">
                        <a href="#modal_create_non_formal_education" data-bs-toggle="modal" class="dropdown-item py-2"><i class="fa-solid fa-pen me-3"></i>Edit</a>
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
            ->addIndexColumn()
            ->rawColumns(['action','DT_RowChecklist'])
            ->make(true);
        }
    }

    public function createUpdateUserFile(Request $request) {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'user_id' => "required",
            'name' => "required",
            'held_by' => "required",
            'start_year' => "required",
            'end_year' => "required",
            'duration' => "required",
            'fee' => "required",
        ]);

        $UserFile = UserFile::updateOrCreate(
        [
            "id" => $request->id,
        ], [
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'name' => $request->name,
            'held_by' => $request->held_by,
            'expired_date' => $request->expired_date,
            'start_year' => $request->start_year,
            'end_year' => $request->end_year,
            'duration' => $request->duration,
            'fee' => $request->fee,
        ]);

        if ($request->certificate) {
            $file = $request->file('certificate');
            $filename = time() . '_' . $UserFile->id . "." .  $file->extension();

            if ($UserFile->certificate) {
                $filename = $UserFile->certificate;
            }

            $file->storeAs('personal/education/non-formal-education-certificate', $filename, 'public');

            $UserFile->update(['certificate' => $filename,]);
        }


        return response()->json([
            'status' => "succes",
            'message' => "Data berhasil disimpan",
        ], 200);
    }

    public function deleteUserFile(Request $request) {
        $UserFile = UserFile::whereId($request->id)->first();
        Storage::delete('public/personal/education/non-formal-education-certificate'.$UserFile->certificate);

        $UserFile->delete();

        return response()->json([
            'status' => "succes",
            'message' => "Data berhasil dihapus",
        ], 200);
    }
}
