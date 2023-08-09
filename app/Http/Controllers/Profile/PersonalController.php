<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

use App\Constants;
use App\Models\User;
use App\Models\Employee\UserIdentity;


class PersonalController extends Controller
{
    public function getTableFamily(Request $request) {
        if (request()->ajax()) {
            $query = DB::table('user_families')
            ->where('user_id',$request->user_id)
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
            ->addColumn('DT_RowChecklist', function($check) {
                return '<div class="text-center w-50px"><input name="family_ids" type="checkbox" value="'.$check->id.'"></div>';
            })
            ->addIndexColumn()
            ->rawColumns(['action','DT_RowChecklist'])
            ->make(true);
        }
    }

    public function getTableEmergencyContact(Request $request) {
        if (request()->ajax()) {
            $query = DB::table('user_emergency_contacts')
            ->where('user_id',$request->user_id)
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
            ->addColumn('DT_RowChecklist', function($check) {
                return '<div class="text-center w-50px"><input name="emergency_contact_ids" type="checkbox" value="'.$check->id.'"></div>';
            })
            ->addIndexColumn()
            ->rawColumns(['action','DT_RowChecklist'])
            ->make(true);
        }
    }

    public function getTableFormalEducation(Request $request) {
        if (request()->ajax()) {
            $query = DB::table('user_formal_educations')
            ->where('user_id',$request->user_id)
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
            ->addIndexColumn()
            ->rawColumns(['action','DT_RowChecklist'])
            ->make(true);
        }
    }

    public function getTableNonFormalEducation(Request $request) {
        if (request()->ajax()) {
            $query = DB::table('user_non_formal_educations')
            ->where('user_id',$request->user_id)
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
            ->addColumn('expired_date', function ($education) {
                $data = $education->expired_date ?? "-";
                return $data;
            })

            ->addIndexColumn()
            ->rawColumns(['action','DT_RowChecklist'])
            ->make(true);
        }
    }

    public function getTableExperience(Request $request) {
        if (request()->ajax()) {
            $query = DB::table('user_working_experiences')
            ->where('user_id',$request->user_id)
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
            ->addIndexColumn()
            ->rawColumns(['action','DT_RowChecklist'])
            ->make(true);
        }
    }

    public function updatePersonal(Request $request) {
        $getUser = User::where('id',$request->user_id)->first();
        // try {
            $file_sign = $request->pegawai_sign_url;
            if ($file_sign != null && $file_sign != '') {
                $image_parts = explode(";base64,", $file_sign);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $file_sign = sys_get_temp_dir() . '/' . uniqid().'.'.$image_type;
                file_put_contents($file_sign, $image_base64);
                $tmpFile = new File($file_sign);
                $file = new UploadedFile(
                    $tmpFile->getPathname(),
                    $tmpFile->getFilename(),
                    $tmpFile->getMimeType(),
                    0,
                    true
                );
                $file_sign = $file->store('sign_pegawai');
            }else{
                $file_sign = $getUser->sign_file;
            }

            $updateUser = $getUser->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'kontak'=>$request->kontak,
                'sign_file'=>$file_sign,
            ]);

            $updateUserPersonalData = $getUser->userPersonalData->update([
                "birthdate" => $request->birthdate,
                "place_of_birth" => $request->place_of_birth,
                "marital_status" => $request->marital_status,
                "gender" => $request->gender,
                "blood_type" => $request->blood_type,
                "religion" => $request->religion,
            ]);

            if ($request->role_id) {
                DB::table('model_has_roles')->where('model_id',$request->user_id)->delete();
                $getUser->assignRole($request->role_id);
            }

            if($request->new_password != null){
                $getUser->update([
                    'password' => bcrypt($request->new_password)
                ]);
            }

            return response()->json([
                "status" => "Yeay Berhasil!! 💼",
            ]);
        // }
        // catch (\Throwable $th) {
        //     Log::error($th);
        //     return response()->json("Oopss, ada yang salah nih!", 500);
        // }
    }

    public function updateIdentity(Request $request) {
        $request->validate([
            'identity_type' => 'nullable|string|max:10',
            'identity_number' => 'nullable|string|max:25',
            'identity_expire_date' => 'nullable|date',
            'postal_code' => 'nullable|string|max:6',
            'citizen_id_address' => 'nullable|string|max:100',
            'residential_address' => 'nullable|string|max:100',
        ]);

        UserIdentity::where('user_id', $request->user_id)->update([
            'type' => $request->identity_type,
            'number' => $request->identity_number,
            'expire_date' => $request->identity_expire_date,
            'postal_code' => $request->postal_code,
            'citizen_id_address' => $request->citizen_id_address,
            'residential_address' => $request->residential_address,
        ]);

        return response()->json([
            "status" => "success",
            "message" => "berhasil menambahkan employee"
        ], 201);
    }
}
