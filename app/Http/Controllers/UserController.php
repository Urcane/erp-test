<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Division;
use App\Models\Team\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{   
    public function index()
    {
        $dataDivision = Division::all();
        $dataDepartment = Department::all();
        $dataUser = User::where('status',1)->get();
        $dataRole = Role::all();
        $dataPlacement= Team::all();
        return view('cmt-employee.index',compact('dataDivision','dataPlacement','dataRole','dataUser','dataDepartment'));
    }
    
    public function store(Request $request)
    {   
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
                <a href="mailto:$emp->email" class="text-gray-500">'.$emp->email.'</a>
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
                $mnue = '<li><a href="#kt_modal_edit_karyawan" data-bs-toggle="modal" class="btn_edit_karyawan dropdown-item py-2" data-id="'.$action->id.'"><i class="fa-solid fa-edit me-2"></i>Edit</a></li>';
                
                return '     
                <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <ul class="dropdown-menu">
                <li><span class="dropdown-item py-2">No Action</span></li>
                </ul>
                ';
            })
            ->addIndexColumn()
            ->rawColumns(['dept','div','action','emp'])
            ->make(true);
        }
    }
    
}


