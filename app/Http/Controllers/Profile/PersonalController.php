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
use Illuminate\Support\Facades\Storage;
use App\Utils\ErrorHandler;

use App\Constants;
use App\Models\User;
use App\Models\Employee\UserIdentity;
use App\Models\PersonalInfo\UserFamily;
use App\Models\PersonalInfo\UserEmergencyContact;
use App\Models\PersonalInfo\UserFormalEducation;
use App\Models\PersonalInfo\UserNonFormalEducation;
use App\Models\PersonalInfo\UserWorkingExperience;


class PersonalController extends Controller
{
    private $constants;
    private $errorHandler;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
        $this->constants = new Constants();
    }

    // family
    // {
        public function getTableFamily(Request $request) {
            if (request()->ajax()) {
                $query = DB::table('user_families')
                ->where('user_id',$request->user_id)
                ->orderBy('id','DESC');

                $query = $query->get();
                return DataTables::of($query)
                ->addColumn('action', function ($action) {
                    $edit = '
                    <li>
                        <div class="btn-edit" id="btn-'. $action->id . '">
                            <a href="#modal_create_family" data-bs-toggle="modal" class="dropdown-item py-2"><i class="fa-solid fa-pen me-3"></i>Edit</a>
                        </div>
                    </li>

                    <script>
                        $("#btn-'. $action->id . '").click(function() {
                            $("[name=\'name\']").val("'. $action->name .'")
                            $("[name=\'nik\']").val("'. $action->nik .'")
                            $("[name=\'relationship\']").val("'. $action->relationship .'")
                            $("[name=\'birthdate\']").val("'. $action->birthdate .'")
                            $("[name=\'family_id\']").val("'. $action->id .'")
                            $("[name=\'gender\'] option").each(function() {
                                if ($(this).val() == "'. $action->gender .'") {
                                    $(this).prop("selected", true);
                                }
                            });
                            $("[name=\'marital_status\'] option").each(function() {
                                if ($(this).val() == "'. $action->marital_status .'") {
                                    $(this).prop("selected", true);
                                }
                            });
                            $("[name=\'religion\'] option").each(function() {
                                if ($(this).val() == "'. $action->religion .'") {
                                    $(this).prop("selected", true);
                                }
                            });
                            $("[name=\'job\']").val("'. $action->job .'")
                        });
                    </script>
                    ';
                    $delete = '<li><button data-family_id="' . $action->id . '" onclick="deleteFamily(\'' . $action->id . '\')" class="dropdown-item py-2"><i class="fa-solid fa-trash me-3"></i>Delete</button></li>';
                    return '
                    <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                    <ul class="dropdown-menu">
                    '.$edit.'
                    '.$delete.'
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

        public function createUpdateFamily(Request $request) {
            $request->validate([
                'name' => 'required',
                'nik' => 'required',
                'relationship' => 'required',
                'gender' => ['required', Rule::in($this->constants->gender)],
                'birthdate' => 'required|date',
                'marital_status' => ['required', Rule::in($this->constants->marital_status)],
                'religion' => ['required', Rule::in($this->constants->religion)],
                'job' => 'required',
            ]);

            UserFamily::updateOrCreate(
            [
                "id" => $request->family_id,
            ], [
                "user_id" => $request->user_id,
                'name' => $request->name,
                'nik' => $request->nik,
                'relationship' => $request->relationship,
                'gender' => $request->gender,
                'birthdate' => $request->birthdate,
                'marital_status' => $request->marital_status,
                'religion' => $request->religion,
                'job' => $request->job,
            ]);

            return response()->json([
                'status' => "succes",
                'message' => "Data berhasil disimpan",
            ], 200);
        }

        public function deleteFamily(Request $request) {
            UserFamily::whereId("$request->family_id")->delete();

            return response()->json([
                'status' => "succes",
                'message' => "Data berhasil dihapus",
            ], 200);
        }
    // }

    // emergency contact
    // {
        public function getTableEmergencyContact(Request $request) {
            if (request()->ajax()) {
                $query = DB::table('user_emergency_contacts')
                ->where('user_id',$request->user_id)
                ->orderBy('id','DESC');

                $query = $query->get();
                return DataTables::of($query)
                ->addColumn('action', function ($action) {
                    $edit = '
                    <li>
                        <div class="btn-edit" id="btn-'. $action->id . '">
                            <a href="#modal_create_emergency_contact" data-bs-toggle="modal" class="dropdown-item py-2"><i class="fa-solid fa-pen me-3"></i>Edit</a>
                        </div>
                    </li>

                    <script>
                        $("#btn-'. $action->id . '").click(function() {
                            $("[name=\'id\']").val("'. $action->id .'")
                            $("[name=\'name\']").val("'. $action->name .'")
                            $("[name=\'phone\']").val("'. $action->phone .'")
                            $("[name=\'relationship\']").val("'. $action->relationship .'")
                        });
                    </script>
                    ';
                    $delete = '<li><button onclick="deleteEmergencyContact(\'' . $action->id . '\')" class="dropdown-item py-2"><i class="fa-solid fa-trash me-3"></i>Delete</button></li>';
                    return '
                    <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                    <ul class="dropdown-menu">
                    '.$edit.'
                    '.$delete.'
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

        public function createUpdateEmergencyContact(Request $request) {
            $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'relationship' => 'required',
            ]);

            UserEmergencyContact::updateOrCreate(
            [
                "id" => $request->id,
            ], [
                'user_id' => $request->user_id,
                'name' => $request->name,
                'phone' => $request->phone,
                'relationship' => $request->relationship,
            ]);

            return response()->json([
                'status' => "succes",
                'message' => "Data berhasil disimpan",
            ], 200);
        }

        public function deleteEmergencyContact(Request $request) {
            UserEmergencyContact::whereId("$request->id")->delete();

            return response()->json([
                'status' => "succes",
                'message' => "Data berhasil dihapus",
            ], 200);
        }
    // }

    // formal education
    // {
        public function getTableFormalEducation(Request $request) {
            if (request()->ajax()) {
                $query = DB::table('user_formal_educations')
                ->where('user_id',$request->user_id)
                ->orderBy('id','DESC');

                $query = $query->get();
                return DataTables::of($query)
                ->addColumn('action', function ($action) {
                    $edit = '
                    <li>
                        <div class="btn-edit" id="btn-'. $action->id . '">
                            <a href="#modal_create_formal_education" data-bs-toggle="modal" class="dropdown-item py-2"><i class="fa-solid fa-pen me-3"></i>Edit</a>
                        </div>
                    </li>

                    <script>
                        $("#btn-'. $action->id . '").click(function() {
                            $("[name=\'id\']").val("'. $action->id .'")
                            $("[name=\'name\']").val("'. $action->name .'")
                            $("[name=\'major\']").val("'. $action->major .'")
                            $("[name=\'start_year\']").val("'. $action->start_year .'")
                            $("[name=\'end_year\']").val("'. $action->end_year .'")
                            $("[name=\'score\']").val("'. $action->score .'")
                            $("[name=\'grade\'] option").each(function() {
                                if ($(this).val() == "'. $action->grade .'") {
                                    $(this).prop("selected", true);
                                }
                            });
                        });
                    </script>
                    ';
                    $delete = '<li><button onclick="deleteFormalEducation(\'' . $action->id . '\')" class="dropdown-item py-2"><i class="fa-solid fa-trash me-3"></i>Delete</button></li>';
                    return '
                    <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                    <ul class="dropdown-menu">
                    '.$edit.'
                    '.$delete.'
                    </ul>
                    ';
                })

                ->addColumn('certificate', function ($edu) {
                    $button = '
                    <div class="btn-edit" id="btn-certificate-modal-' . $edu->id . '">
                        <a href="#img_certificate_modal" data-bs-toggle="modal" class="dropdown-item py-2"><i class="fa-solid fa-eye me-3"></i>' . $edu->certificate . '</a>
                    </div>

                    <script>
                        $("#btn-certificate-modal-'. $edu->id . '").click(function() {
                            $("#img_certificate").attr("src", "' . asset('storage/personal/education/formal-education-certificate/' . $edu->certificate) . '");
                        });
                    </script>
                    ';
                    return $button;
                })
                ->addIndexColumn()
                ->rawColumns(['certificate', 'action','DT_RowChecklist'])
                ->make(true);
            }
        }

        public function createUpdateFormalEducation(Request $request) {
            $request->validate([
                'name' => 'required',
                'grade' => ['required', Rule::in($this->constants->grade)],
                'major' => 'required',
                'start_year' => 'required',
                'end_year' => 'required',
                'score' => 'required',
            ]);

            $userFormalEducation = UserFormalEducation::updateOrCreate(
            [
                "id" => $request->id,
            ], [
                'user_id' => $request->user_id,
                'name' => $request->name,
                'grade' => $request->grade,
                'major' => $request->major,
                'start_year' => $request->start_year,
                'end_year' => $request->end_year,
                'score' => $request->score,
            ]);

            if ($request->certificate) {
                $file = $request->file('certificate');
                $filename = time() . '_' . $userFormalEducation->id . "." .  $file->extension();

                if ($userFormalEducation->certificate) {
                    $filename = $userFormalEducation->certificate;
                }

                $file->storeAs('personal/education/formal-education-certificate', $filename, 'public');

                $userFormalEducation->update(['certificate' => $filename,]);
            }

            return response()->json([
                'status' => "succes",
                'message' => "Data berhasil disimpan",
            ], 200);
        }

        public function deleteFormalEducation(Request $request) {
            $userFormalEducation = UserFormalEducation::whereId($request->id)->first();
            Storage::delete('public/personal/education/formal-education-certificate/'.$userFormalEducation->certificate);

            $userFormalEducation->delete();
            return response()->json([
                'status' => "succes",
                'message' => "Data berhasil dihapus",
            ], 200);
        }
    // }

    // non formal education
    // {
        public function getTableNonFormalEducation(Request $request) {
            if (request()->ajax()) {
                $query = DB::table('user_non_formal_educations')
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

                    <script>
                        $("#btn-non-'. $action->id . '").click(function() {
                            $("[name=\'id\']").val("'. $action->id .'")
                            $("[name=\'name\']").val("'. $action->name .'")
                            $("[name=\'held_by\']").val("'. $action->held_by .'")
                            $("[name=\'expired_date\']").val("'. $action->expired_date .'")
                            $("[name=\'start_year\']").val("'. $action->start_year .'")
                            $("[name=\'end_year\']").val("'. $action->end_year .'")
                            $("[name=\'duration\']").val("'. $action->duration .'")
                            $("[name=\'fee\']").val("'. $action->fee .'")
                            $("[name=\'category_id\'] option").each(function() {
                                if ($(this).val() == "'. $action->category_id .'") {
                                    console.log("Asdf")
                                    $(this).prop("selected", true);
                                }
                            });
                        });
                    </script>
                    ';
                    $delete = '<li><button onclick="deleteNonFormalEducation(\'' . $action->id . '\')" class="dropdown-item py-2"><i class="fa-solid fa-trash me-3"></i>Delete</button></li>';
                    return '
                    <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                    <ul class="dropdown-menu">
                    '.$edit.'
                    '.$delete.'
                    </ul>
                    ';
                })
                ->addColumn('expired_date', function ($education) {
                    $data = $education->expired_date ?? "-";
                    return $data;
                })
                ->addColumn('certificate', function ($edu) {
                    $button = '
                    <div class="btn-edit" id="btn-certificate-modal-non-' . $edu->id . '">
                        <a href="#img_certificate_modal" data-bs-toggle="modal" class="dropdown-item py-2"><i class="fa-solid fa-eye me-3"></i>' . $edu->certificate . '</a>
                    </div>

                    <script>
                        $("#btn-certificate-modal-non-'. $edu->id . '").click(function() {
                            $("#img_certificate").attr("src", "' . asset('storage/personal/education/non-formal-education-certificate/' . $edu->certificate) . '");
                        });
                    </script>
                    ';
                    return $button;
                })
                ->addIndexColumn()
                ->rawColumns(['certificate','action','DT_RowChecklist'])
                ->make(true);
            }
        }

        public function createUpdateNonFormalEducation(Request $request) {
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

            $userNonFormalEducation = UserNonFormalEducation::updateOrCreate(
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
                $filename = time() . '_' . $userNonFormalEducation->id . "." .  $file->extension();

                if ($userNonFormalEducation->certificate) {
                    $filename = $userNonFormalEducation->certificate;
                }

                $file->storeAs('personal/education/non-formal-education-certificate', $filename, 'public');

                $userNonFormalEducation->update(['certificate' => $filename,]);
            }


            return response()->json([
                'status' => "succes",
                'message' => "Data berhasil disimpan",
            ], 200);
        }

        public function deleteNonFormalEducation(Request $request) {
            $userNonFormalEducation = UserNonFormalEducation::whereId("$request->id")->first();
            Storage::delete('public/personal/education/non-formal-education-certificate/'.$userNonFormalEducation->certificate);

            $userNonFormalEducation->delete();

            return response()->json([
                'status' => "succes",
                'message' => "Data berhasil dihapus",
            ], 200);
        }
    // }

    // work experience
    // {
        public function getTableExperience(Request $request) {
            if (request()->ajax()) {
                $query = DB::table('user_working_experiences')
                ->where('user_id',$request->user_id)
                ->orderBy('id','DESC');

                $query = $query->get();
                return DataTables::of($query)
                ->addColumn('action', function ($action) {
                    $edit = '
                    <li>
                        <div class="btn-edit" id="btn-work-'. $action->id . '">
                            <a href="#modal_create_work_experience" data-bs-toggle="modal" class="dropdown-item py-2"><i class="fa-solid fa-pen me-3"></i>Edit</a>
                        </div>
                    </li>

                    <script>
                        $("#btn-work-'. $action->id . '").click(function() {
                            $("[name=\'id\']").val("'. $action->id .'")
                            $("[name=\'name\']").val("'. $action->name .'")
                            $("[name=\'position\']").val("'. $action->position .'")
                            $("[name=\'start_date\']").val("'. $action->start_date .'")
                            $("[name=\'end_date\']").val("'. $action->end_date .'")
                        });
                    </script>
                    ';
                    $delete = '<li><button onclick="deleteWorkExperience(\'' . $action->id . '\')" class="dropdown-item py-2"><i class="fa-solid fa-trash me-3"></i>Delete</button></li>';
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

        public function createUpdateWorkExperience(Request $request) {
            $request->validate([
                'name' => 'required',
                'position' => "required",
                'start_date' => "required",
                'end_date' => "required",
            ]);

            UserWorkingExperience::updateOrCreate(
            [
                "id" => $request->id,
            ], [
                'user_id' => $request->user_id,
                'name' => $request->name,
                'position' => $request->position,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            return response()->json([
                'status' => "succes",
                'message' => "Data berhasil disimpan",
            ], 200);
        }

        public function deleteWorkExperience(Request $request) {
            UserWorkingExperience::whereId("$request->id")->delete();

            return response()->json([
                'status' => "succes",
                'message' => "Data berhasil dihapus",
            ], 200);
        }
    // }

    public function updatePersonal(Request $request) {
        if($request->header('authorization')) {
            $getUser = $request->user();
        } else {
            $getUser = User::where('id',$request->user_id)->first();
        }

        try {
            // dd("Asdf");
            // $file_sign = $request->pegawai_sign_url;
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
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
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
            "message" => "Data berhasil disimpan"
        ], 201);
    }
}
