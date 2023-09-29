<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Division;
use App\Models\Team\Team;
use App\Models\User;
use App\Models\Employee\EmploymentStatus;
use App\Models\Employee\UserPersonalData;
use App\Models\Employee\SubBranch;
use App\Models\Employee\WorkingSchedule;
use App\Models\Employee\PaymentSchedule;
use App\Models\Employee\ProrateSetting;
use App\Models\Employee\TaxStatus;

use App\Constants;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\File\File;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index()
    {
        $dataDivision = Division::all();
        $dataDepartment = Department::all();
        $dataUser = User::where('status',1)->get();
        $dataRole = Role::all();
        $dataPlacement= Team::all();

        return view('hc.cmt-employee.index',compact('dataDivision','dataPlacement','dataRole','dataUser','dataDepartment'));
    }

    public function create() {
        $dataPermissions = Permission::all();
        $dataDepartment = Department::all();
        $dataDivision = Division::all();
        $user = null;
        $users = User::get();
        $dataTeam = Team::get();
        $dataEmploymentStatus = EmploymentStatus::all();
        $dataRole = Role::all();
        $constants = new Constants();
        $dataSubBranch = SubBranch::all();
        $dataWorkingSchedule = WorkingSchedule::all();
        $dataTaxStatus = TaxStatus::all();

        $dataPaymentSchedule = PaymentSchedule::all();
        $dataProrateSetting = ProrateSetting::all();

        return view('hc.cmt-employee.form-tambah-pegawai',compact(
            'user',
            'users',
            'dataDepartment',
            "dataDivision",
            "dataTeam",
            "dataTaxStatus",
            'dataRole',
            'constants',
            "dataEmploymentStatus",
            "dataSubBranch",
            "dataWorkingSchedule",
            "dataPaymentSchedule",
            "dataProrateSetting",
            'dataPermissions'
        ));
    }

    public function store(Request $request) {
        try {
            $getDiv = Division::where('id',$request->division_id)->first();
            $create = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'nip'=>$request->nip,
                'nik'=>$request->nik,
                'kontak'=>$request->kontak,
                'division_id'=>$request->division_id,
                'department_id'=>$getDiv->department_id,
                'password' => bcrypt($request->new_password),
                'team_id'=>$request->team_id,
            ]);
            $create->assignRole($request->role_id);

            return response()->json([
                "status" => "Yeay Berhasil!! 💼",
            ]);
        }
        catch (\Throwable $th) {
            Log::error($th);
            return response()->json("Oopss, ada yang salah nih!", 500);
        }
    }



    public function statusPegawai(Request $request)
    {
        try {
            foreach ($request->pegawai_id as $id) {
                if($request->status_pegawai != 0){
                    $update = User::where('id',$id)->update([
                        'status' => 1,
                    ]);
                }else{
                    $update = User::where('id',$id)->update([
                        'status' => 0,
                    ]);
                }
            }

            return response()->json([
                "status" => "Yeay Berhasil!! 💼",
            ]);
        }
        catch (\Throwable $th) {
            Log::error($th);
            return response()->json("Oopss, ada yang salah nih!", 500);
        }
    }

    public function resetPasswordPegawai(Request $request)
    {
        try {
            foreach ($request->pegawai_id as $id) {
                    $update = User::where('id',$id)->update([
                        'password' => bcrypt(12345678),
                    ]);
            }

            return response()->json([
                "status" => "Yeay Berhasil!! 💼",
            ]);
        }
        catch (\Throwable $th) {
            Log::error($th);
            return response()->json("Oopss, ada yang salah nih!", 500);
        }
    }

    public function getTableEmployee(Request $request)
    {
        if (request()->ajax()) {
            $query = DB::table('users')
            ->join('departments','departments.id','users.department_id')
            ->join('divisions','divisions.id','users.division_id')
            ->select('users.*','departments.department_name','divisions.divisi_name')
            ->where('users.status',1)
            ->orderBy('users.id','DESC');

            $filterDivisi = $request->filters['filterDivisi'];
            if(!empty($filterDivisi) && $filterDivisi !== '*'){
                $query->where('users.division_id', $filterDivisi);
            }else{
                $query;
            }

            $filterDepartment = $request->filters['filterDepartment'];
            if(!empty($filterDepartment) && $filterDepartment !== '*'){
                $query->where('users.department_id', $filterDepartment);
            }else{
                $query;
            }

            $query = $query->get();
            return DataTables::of($query)
            ->addColumn('emp', function ($emp){
                if($emp->foto_file != null){
                    $foto = '<img src="'.asset('sense').'/media/foto_pegawai/'.$emp->foto_file.'" alt="user" />';
                }else{
                    $foto = '<img src="'.asset('sense').'/media/avatars/blank.png" alt="user" />';
                }
                return '
                <div class="d-flex">
                <div class="symbol symbol-circle symbol-35px overflow-hidden me-5">
                '.$foto.'
                </div>
                <div>
                <span class="mb-0 fw-bold d-block">'.$emp->name.'</span>
                <a href="mailto:'.$emp->email.'" class="text-gray-500">'.$emp->email.'</a>
                </div>
                </div>
                ';
            })
            ->addColumn('kontak', function ($kontak){
                if($kontak->kontak != null){
                    return '+62'.$kontak->kontak;
                }else{
                    return '';
                }
            })
            ->addColumn('dept', function ($dept){
                return '<span class="badge px-3 py-2 badge-light-primary">'.$dept->department_name.'</span>';
            })
            ->addColumn('div', function ($div){
                return '<span class="badge px-3 py-2 badge-light-warning">'.$div->divisi_name.'</span>';
            })
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
                if($check->status != 0 && Auth::user()->id != $check->id && Auth::user()->getRoleNames()[0] == 'administrator'){
                return '<div class="text-center w-50px"><input name="pegawai_ids" type="checkbox" value="'.$check->id.'"></div>';
                }else{
                    return '';
                }
            })
            ->addIndexColumn()
            ->rawColumns(['dept','div','action','emp','DT_RowChecklist'])
            ->make(true);
        }
    }

}


