<?php

namespace App\Http\Controllers\HC\Settings\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

use App\Exceptions\NotFoundError;
use App\Exceptions\InvariantError;
use App\Utils\ErrorHandler;

use App\Models\Employee\SubBranch;

class BranchController extends Controller
{
    private $errorHandler;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
    }

    public function index()
    {
        return view("hc.cmt-settings.company.branch.branch");
    }

    public function getTableBranch(Request $request)
    {
        if (request()->ajax()) {
            $query = SubBranch::where("branch_id", null);

            $query = $query->get();

            // dd($query);
            return DataTables::of($query)
                ->addColumn('action', function ($action) {
                    $edit = '
                <li>
                    <div class="btn-edit" id="btn-' . $action->id . '">
                        <a href="' . route('hc.setting.branch.edit', ["id" => $action->id]) . '" class="dropdown-item py-2"><i class="fa-solid fa-pen me-3"></i>Edit</a>
                    </div>
                </li>
                ';
                    $delete = '<li><a href="#delete_confirmation_Branch" data-bs-toggle="modal" onclick="deleteBranch(\'' . $action->id . '\')" class="dropdown-item py-2"><i class="fa-solid fa-trash me-3"></i>Delete</a></li>';
                    return '
                <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <ul class="dropdown-menu">
                ' . $edit . '
                ' . $delete . '
                </ul>
                ';
                })
                ->addColumn('parent', function ($branch) {
                    return $branch->parent->name;
                })
                ->addColumn('DT_RowChecklist', function ($check) {
                    return '<div class="text-center w-50px"><input name="family_ids" type="checkbox" value="' . $check->id . '"></div>';
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'DT_RowChecklist'])
                ->make(true);
        }
    }

    public function create()
    {
        $dataParent = SubBranch::all();

        return view("hc.cmt-settings.company.branch.create-update-branch", compact(['dataParent']));
    }

    public function edit($id)
    {
        $dataParent = SubBranch::all();
        $subBranch = DB::table('sub_branches')->where("id", $id)->first();

        return view("hc.cmt-settings.company.branch.create-update-branch", compact(['dataParent', 'subBranch']));
    }

    public function createUpdate(Request $request)
    {
        try {
            $request->validate([
                "name" => "required",
                "phone_number" => "required",
                "email" => "required",
                "address" => "required",
                "latitude" => "required",
                "longitude" => "required",
                "coordinate_radius" => "required",
                "city" => "required",
                "province" => "required",
                "npwp" => "required",
                "tax_name" => "required",
                "tax_person_name" => "required",
                "tax_person_npwp" => "required",
                "klu" => "required",
            ]);

            $subBranch = SubBranch::updateOrCreate([
                "id" => $request->company_id,
            ], [
                "name" => $request->name,
                "phone_number" => $request->phone_number,
                "email" => $request->email,
                "address" => $request->address,
                "latitude" => $request->latitude,
                "longitude" => $request->longitude,
                "coordinate_radius" => $request->coordinate_radius,
                "city" => $request->city,
                "province" => $request->province,
                "npwp" => $request->npwp,
                "tax_name" => $request->name,
                "tax_person_name" => $request->tax_person_name,
                "tax_person_npwp" => $request->tax_person_npwp,
                "klu" => $request->klu,
                "umr" => $request->umr,
                "branch_id" => null,
                "parent_id" => $request->parent_id,
            ]);

            if ($request->logo) {
                $file = $request->file('logo');
                $filename = time() . '_' . $request->name;
                if ($subBranch->logo) {
                    $filename = $subBranch->logo;
                }
                $file->storeAs('branch-logo', $filename, 'public');

                $subBranch->update([
                    "logo" => $filename,
                ]);
                // Storage::disk('local')->putFile('public/branch-logo', $file);
            }
            if ($request->signature) {
                $file = $request->file('signature');
                $filename = time() . '_' . $request->name;
                if ($subBranch->logo) {
                    $filename = $subBranch->logo;
                }
                $file->storeAs('branch-signature', $filename, 'public');

                $subBranch->update([
                    "signature" => $filename,
                ]);
            }

            return redirect(route("hc.setting.branch.index"));
        } catch (\Throwable $th) {

            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $branch = SubBranch::whereId($request->id)->first();
            if (!$branch) {
                throw new NotFoundError("Data tidak ditemukan");
            }

            if ($branch->userEmployments->first() || $branch->child->first()) {
                throw new InvariantError("Branch masi memiliki bawahan");
            }

            foreach ($branch->branchLocations as $data) {
                $data->delete();
            }

            Storage::delete('public/branch-signature/' . $branch->signature);
            Storage::delete('public/branch-logo/' . $branch->logo);
            $branch->delete();

            return response()->json([
                'status' => "succes",
                'message' => "Data berhasil dihapus",
            ], 200);
        } catch (\Throwable $th) {

            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }
}
