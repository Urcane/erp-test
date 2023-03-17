<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Team\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $dataDivision = Division::all();
        $dataRole = Role::all();
        $dataPlacement= Team::all();
        return view('cmt-employee.index',compact('dataDivision','dataPlacement','dataRole'));
    }

    public function storeEmployee(Request $request)
    {
        $sign_file = $request->sign_file;
        $getDiv = Division::where('id',$request->division_id)->first();
        
        if ($request->sign_file != null && $request->sign_file != '') {
            $sign_file = $request->sign_file->getClientOriginalName();
            $request->sign_file->move($path, $sign_file);   
        }

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

        return response()->json($create);
    }
    
    public function getTableEmployee(Request $request)
    {  
        if (request()->ajax()) {
            $query = DB::table('users')
            ->join('departments','departments.id','users.department_id')
            ->join('divisions','divisions.id','users.division_id')
            ->orderBy('users.id','DESC');
            $query = $query->get();
            return DataTables::of($query)
            ->addColumn('emp', function ($emp){
                return '
                <div class="d-flex">
                <div class="symbol symbol-35px overflow-hidden me-5">
                <div class="symbol-label fs-3 bg-light-primary text-primary"><i class="fa-solid fa-user text-primary"></i></div>
                </div>
                <div>
                <span class="mb-0 fw-bold d-block">'.$emp->name.'</span>
                <a href="mailto:$emp->email" class="text-primary"><i class="fa-solid fa-envelope me-2 text-muted"></i>'.$emp->email.'</a>
                </div>
                </div>
                ';
            })
            ->addColumn('dept', function ($dept){
                return "
                <span class=\"badge px-3 py-2 badge-light-primary\">$dept->department_name</span>
                ";
            })
            ->addColumn('div', function ($div){
                return "
                <span class=\"badge px-3 py-2 badge-light-info\">$div->divisi_name</span>
                ";
            })
            ->addColumn('status', function ($status){
                if($status->status == 0){
                    return "
                    <span class=\"badge px-3 py-2 badge-light-danger\"><i class=\"fa-solid fa-times me-2 text-danger\"></i>Non Aktif</span>
                    ";
                }else{
                    return "
                    <span class=\"badge px-3 py-2 badge-light-success\"><i class=\"fa-solid fa-check me-2 text-success\"></i>Aktif</span>
                    ";
                }
            })
                ->addColumn('action', function ($action) {
                    return '     
                    <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                    <ul class="dropdown-menu">
                        <li><a href="#kt_modal_edit_karyawan" data-bs-toggle="modal" class="btn_edit_karyawan dropdown-item py-2" data-id="'.$action->id.'"><i class="fa-solid fa-edit me-2"></i>Edit</a></li>
                    </ul>
                    ';
                })
                    ->addIndexColumn()
                    ->rawColumns(['status','dept','div','action','emp'])
                    ->make(true);
                }
            }
        }
        
        
        