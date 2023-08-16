<?php

namespace App\Http\Controllers\HC\Settings\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Employee\SubBranch;
use App\Models\Employee\Branch;

class CompanyInfoController extends Controller
{
    public function index() {
        $subBranch = SubBranch::where("branch_id", '!=', null)->first();

        return view("hc.cmt-settings.company.company-info", compact(["subBranch"]));
    }

    public function update(Request $request) {

        $branch = Branch::updateOrCreate(
        [
            "id" => $request->company_id,
        ], [
            "industry" => $request->industry,
            "company_size" => $request->company_size,
            "company_taxable_date" => $request->company_taxable_date,
            "head_office_initial" => $request->head_office_initial,
            "bpjs_ketenagakerjaan" => $request->bpjs_ketenagakerjaan,
            "jaminan_kecelakaan_kerja" => $request->jaminan_kecelakaan_kerja,

        ]);

        $subBranch = SubBranch::updateOrCreate([
            "branch_id" => $request->company_id,
        ], [
            "name" => $request->name,
            "phone_number" => $request->phone_number,
            "email" => $request->email,
            "address" => $request->address,
            "city" => $request->city,
            "province" => $request->province,
            "npwp" => $request->npwp,
            "tax_name" => $request->name,
            "tax_person_name" => $request->tax_person_name,
            "tax_person_npwp" => $request->tax_person_npwp,
            "umr" => $request->umr,
            "klu" => $request->klu,
            "branch_id"=> $branch->id,
            "parent_id"=> null,
        ]);

        if ($request->logo) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            if ($subBranch->logo) {
                $filename = $subBranch->logo;
            }
            $file->storeAs('branch-logo', $filename, 'public');

            $subBranch->update([
                "logo" => $filename,
            ]);
            // Storage::disk('local')->putFile('public/company-logo', $file);
        }
        if ($request->signature) {
            $file = $request->file('signature');
            $filename = time() . '_' . $file->getClientOriginalName();
            if ($subBranch->logo) {
                $filename = $subBranch->logo;
            }
            $file->storeAs('branch-signature', $filename, 'public');

            $subBranch->update([
                "signature" => $filename,
            ]);
        }

        return back();
    }
}
