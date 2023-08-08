<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class FamilyController extends Controller
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
}
