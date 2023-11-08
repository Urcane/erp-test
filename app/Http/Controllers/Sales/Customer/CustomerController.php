<?php

namespace App\Http\Controllers\Sales\Customer;

use App\Http\Controllers\Controller;
use App\Models\BussinesType;
use App\Models\Customer\Customer;
use App\Models\Customer\CustomerContact;
use App\Models\Customer\CustomerProspect;
use App\Models\Customer\CustomerProspectLog;
use App\Models\LeadReference;
use App\Models\Team\City;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;

class CustomerController extends Controller
{
    public function indexLead()
    {
        $getLead = LeadReference::get();
        $getCity = City::get();
        $getBussines = BussinesType::get();
        return view('cmt-customer.lead.index', compact('getLead','getBussines','getCity'));
    }

    public function storeLead(Request $request)
    {
        try {
            DB::beginTransaction();
            $company = Customer::create([
                'user_id' => Auth::user()->id,
                'customer_name' => $request->customer_name,
                'bussines_type_id' => $request->bussines_type_id,
                'lead_reference_id' => $request->lead_reference_id,
                'city_id' => $request->city_id,
                'customer_address' => $request->customer_address,
                'lat' => $request->lat,
                'lng' => $request->lng,
            ]);

            Log::info($request->all());

            $contact = CustomerContact::create([
                'customer_id' => $company->id,
                'customer_contact_name' => $request->input('customer_contact_name', '-') ?? '-',
                'customer_contact_job' => $request->input('customer_contact_job', '-') ?? '-',
                'customer_contact_email' => $request->input('customer_contact_email'),
                'customer_contact_phone' => $request->input('customer_contact_phone', '00000000000') ?? '00000000000',
            ]);

            DB::commit();
            return response()->json([
                "status" => "Yeay Berhasil!! 💼",
            ]);
        }
        catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);
            return response()->json("Oopss, ada yang salah nih!", 500);
        }
    }

    public function updateLead(Request $request)
    {
        try {
            $company = Customer::where('id',$request->lead_id)->update([
                'customer_name' => $request->customer_name,
                'bussines_type_id' => $request->bussines_type_id,
                'lead_reference_id' => $request->lead_reference_id,
                'city_id' => $request->city_id,
                'customer_address' => $request->customer_address,
                'lat' => $request->lat,
                'lng' => $request->lng,
            ]);
            $contact = CustomerContact::where('customer_id',$request->lead_id)->update([
                'customer_contact_name' => $request->customer_contact_name,
                'customer_contact_job' => $request->customer_contact_job,
                'customer_contact_email' => $request->customer_contact_email,
                'customer_contact_phone' => $request->customer_contact_phone,
            ]);

            return response()->json([
                "status" => "Yeay Berhasil!! 💼",
            ]);
        }
        catch (\Throwable $th) {
            Log::error($th);
            return response()->json("Oopss, ada yang salah nih!", 500);
        }
    }

    public function tindakLanjutLead(Request $request)
    {
        try {
            $getUser = User::where('id',Auth::user()->id)->first();
            foreach ($request->lead_id as $id) {
                if($id != null){
                    Customer::where('id',$id)->update([
                        'user_follow_up' => Auth::user()->id,
                        'prospect_status' => 1,
                        'approval_manager' => 1,
                        'status' => 1,
                    ]);

                    $temp_title = Carbon::now()->toDateString() . ' - Pembukaan Prospect';
                    $prospek = CustomerProspect::create([
                        'customer_id' => $id,
                        'prospect_title' => $request->prospect_title ?? $temp_title,
                    ]);

                    $prospek_logs = CustomerProspectLog::create([
                        'customer_prospect_id' => $prospek->id,
                        'prospect_update' => 'Lead telah ditindaklanjuti oleh '.$getUser->name,
                        'prospect_next_action' => $request->prospect_next_action,
                        'next_action_plan_date' => Carbon::parse($request->next_action_plan_date . $request->next_action_plan_time)->toDateTimeString(),
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

    public function updateProspect(Request $request)
    {
        try {
            $lead = Customer::where('id',$request->lead_id);
            $lead->update([
                'status' => $request->prospect_status,
            ]);

            if ($request->prospect_status == 2 || $request->prospect_status == 0) {
                $lead->update([
                    'prospect_status' => 0,
                ]);
            }

            $prospek = CustomerProspectLog::create([
                'customer_prospect_id' => $request->customer_prospect_id,
                'prospect_update' => $request->prospect_update,
                'prospect_next_action' => $request->prospect_next_action,
                'next_action_plan_date' => Carbon::parse($request->next_action_plan_date . $request->next_action_plan_time)->toDateTimeString(),
                'status' => $request->prospect_status,
            ]);

            return response()->json([
                "status" => "Yeay Berhasil!! 💼",
            ]);
        }
        catch (\Throwable $th) {
            Log::error($th);
            return response()->json("Oopss, ada yang salah nih!", 500);
        }
    }

    public function batalProspect(Request $request)
    {
        try {
            $getUser = User::where('id',Auth::user()->id)->first();
            foreach ($request->prospect_id as $id) {
                if($id != null){
                    $prospek = CustomerProspectLog::create([
                        'customer_prospect_id' => $id,
                        'prospect_next_action' => $request->prospect_next_action,
                        'prospect_update' => $request->prospect_update.' '.$getUser->name,
                        'status' => $request->prospect_status,
                    ]);
                    $lead = Customer::where('id',$id)->update([
                        'status' => $request->prospect_status,
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

    public function getEditLead($id)
    {
        $lead = DB::table('customers')
        ->join('customer_contacts','customer_contacts.customer_id','customers.id')
        ->select('customers.*','customer_contacts.customer_contact_name','customer_contacts.customer_contact_job','customer_contacts.customer_contact_phone','customer_contacts.customer_contact_email')
        ->where('customers.id',$id)
        ->first();

        return response()->json($lead);
    }

    public function getTableLead(Request $request)
    {
        if (request()->ajax()) {
            $query = DB::table('customers')
            ->join('users','users.id','customers.user_id')
            ->join('cities','cities.id','customers.city_id')
            ->join('lead_references','lead_references.id','customers.lead_reference_id')
            ->join('bussines_types','bussines_types.id','customers.bussines_type_id')
            ->join('customer_contacts','customer_contacts.customer_id','customers.id')
            ->select(
                'customers.*',
                'users.name as sales_name',
                'customer_contacts.customer_contact_name',
                'customer_contacts.customer_contact_phone',
                'customer_contacts.customer_contact_email',
                'customer_contacts.customer_contact_job',
                'cities.city_name',
                'lead_references.lead_reference_name',
                'bussines_types.type_name as bussines_type_name'
            )
            ->where('customers.deleted_at',null)
            ->orderBy('customers.id','DESC');

            if ($range_date = $request->filters['range_date']) {
                $range_date = collect(explode('-', $request->filters['range_date']))->map(function($item) {
                    return Carbon::parse($item)->toDateString();
                })->toArray();

                $query->whereBetween('customers.created_at', $range_date);
            }

            $query = $query->get();
            return DataTables::of($query)
            ->addColumn('customer', function ($customer){
                return '
                <span class="fw-bold d-block">'.$customer->customer_name.'</span>
                <p class="text-gray-500 mb-0">'.$customer->customer_address.'</p>
                <span class="text-gray-500">'.$customer->city_name.'</span>
                ';
            })
            ->addColumn('kontak', function ($kontak){
                return '
                <span class="mb-0 fw-bold d-block">'.$kontak->customer_contact_name.'</span>
                <span class="text-gray-500 d-block">+62'.$kontak->customer_contact_phone.'</span>
                ';
            })
            ->addColumn('status', function ($status){
                if($status->prospect_status == 0 && $status->status == 1){
                    $badge = 'primary';
                    $icon = 'fa-pen';
                    $text = 'Lead';
                }elseif($status->prospect_status != 0 && $status->status == 1){
                    $badge = 'warning';
                    $icon = 'fa-building-circle-check';
                    $text = 'Prospek';
                }elseif($status->status == 2){
                    $badge = 'success';
                    $icon = 'fa-check';
                    $text = 'Goal';
                }else{
                    $badge = 'danger';
                    $icon = 'fa-times';
                    $text = 'Batal';
                }
                return '<span class="badge px-3 py-2 badge-light-'.$badge.'"><i class="fa-solid text-'.$badge.' '.$icon.' me-3"></i>'.$text.'</span>';
            })
            ->addColumn('action', function ($action) {
                $mnue = '
                <li><a href="#kt_modal_edit_lead" class="dropdown-item py-2 btn_edit_lead" data-bs-toggle="modal" data-id="'.$action->id.'"><i class="fa-solid fa-edit me-3"></i>Edit</a></li>
                ';
                return '
                <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <ul class="dropdown-menu">
                '.$mnue.'
                </ul>
                ';
            })
            ->addColumn('DT_RowChecklist', function($check) {
                // Auth::user()->getRoleNames()->first() == 'administrator' &&
                if($check->prospect_status == null){
                    return '<div class="text-center w-50px"><input name="checkbox_lead_ids" type="checkbox" value="'.$check->id.'"></div>';
                }
                    // return '';
                // }
            })
            //kebutuhan export
            ->addColumn('lead_year', function ($lead_year){
                return Carbon::parse($lead_year->created_at)->format('Y');
            })
            ->addColumn('lead_date', function ($lead_date){
                return Carbon::parse($lead_date->created_at)->format('d-m-Y');
            })
            ->addColumn('lead_week_number', function ($lead_week_number){
                $date = Carbon::parse($lead_week_number->created_at);
                return $date->weekOfMonth;
            })
            ->addColumn('lead_company_name', function ($company_name){
                return $company_name->customer_name;
            })
            ->addColumn('lead_company_city', function ($company_city){
                return $company_city->city_name;
            })
            ->addColumn('lead_company_address', function ($company_address){
                return $company_address->customer_address;
            })
            ->addColumn('lead_company_lat', function ($company_lat){
                return $company_lat->lat;
            })
            ->addColumn('lead_company_lng', function ($company_lng){
                return $company_lng->lng;
            })
            ->addColumn('lead_company_contact_name', function ($company_contact_name){
                return $company_contact_name->customer_contact_name;
            })
            ->addColumn('lead_company_contact_email', function ($company_contact_email){
                return $company_contact_email->customer_contact_email;
            })
            ->addColumn('lead_company_contact_job', function ($company_contact_job){
                return $company_contact_job->customer_contact_job;
            })
            ->addColumn('lead_company_contact_phone', function ($company_contact_phone){
                return $company_contact_phone->customer_contact_phone;
            })
            ->addColumn('lead_status', function ($lead_status){
                if($lead_status->prospect_status == 0 && $lead_status->status == 1){
                    $text = 'Lead';
                }elseif($lead_status->prospect_status != 0 && $lead_status->status == 1){
                    $text = 'Prospek';
                }elseif($lead_status->status == 2){
                    $text = 'Goal';
                }else{
                    $text = 'Batal';
                }
                return $text;
            })
            ->addColumn('lead_note', function ($lead_note){
                $getProspek = CustomerProspect::where('customer_id',$lead_note->id)->orderBy('id','DESC')->first();
                if($getProspek){
                    return $getProspek->prospect_update;
                }else{
                    return '';
                }
            })
            ->addColumn('lead_next_action', function ($lead_next_action){
                $getProspek = CustomerProspect::where('customer_id',$lead_next_action->id)->orderBy('id','DESC')->first();
                if($getProspek){
                    return $getProspek->prospect_next_action;
                }else{
                    return '';
                }
            })
            ->addIndexColumn()
            ->rawColumns(['action','customer','kontak','status','DT_RowChecklist'])
            ->make(true);
        }
    }

    public function getTableProspect(Request $request)
    {
        if (request()->ajax()) {
            $query = DB::table('customers')
            ->join('users','users.id','customers.user_id')
            ->join('cities','cities.id','customers.city_id')
            ->join('customer_prospects', 'customer_prospects.customer_id', 'customers.id')
            ->select(
                'customers.*',
                'users.name as sales_name',
                'cities.city_name',
                'customer_prospects.prospect_title',
                'customer_prospects.id as prospect_id',
            )
            ->where('customers.deleted_at',null)
            ->where('customers.prospect_status','!=',null)
            ->orderBy('customer_prospects.id','DESC');

            if ($range_date = $request->filters['range_date']) {
                $range_date = collect(explode('-', $request->filters['range_date']))->map(function($item) {
                    return Carbon::parse($item)->toDateString();
                })->toArray();

                $query->whereBetween('customers.created_at', $range_date);
            }

            $query = $query->get();

            $pluck_prospect_id = $query->pluck('prospect_id');
            $getLogs = CustomerProspectLog::whereIn('customer_prospect_id',$pluck_prospect_id)->orderBy('id','DESC')->get();

            return DataTables::of($query)
            ->addColumn('customer', function ($customer){
                return '
                <span class="fw-bold d-block">'.$customer->customer_name.'</span>
                <p class="text-gray-500 mb-0">'.$customer->customer_address.'</p>
                <span class="text-gray-500">'.$customer->city_name.'</span>
                ';
            })
            ->addColumn('progress', function ($progress) use($getLogs) {
                $getProgress = $getLogs->where('customer_prospect_id', $progress->prospect_id)->slice(0,3);
                $list = '';
                foreach ($getProgress as $gp) {
                    if($gp->status == 1){
                        $statusPrg = 'warning';
                        $iconPrg = 'fa-clock';
                    }elseif($gp->status == 0){
                        $statusPrg = 'danger';
                        $iconPrg = 'fa-times';
                    }else{
                        $statusPrg = 'success';
                        $iconPrg = 'fa-check';
                    }
                    $list .= '
                    <div class="timeline-item">
                        <div class="timeline-line w-35px"></div>
                        <div class="timeline-icon symbol symbol-circle symbol-35px">
                            <div class="symbol-label bg-light-'.$statusPrg.'">
                                <i class="fa-solid '.$iconPrg.' text-'.$statusPrg.'"></i>
                            </div>
                        </div>
                        <div class="timeline-content">
                            <div class="pe-5">
                                <span class="fw-bold d-block">'.$gp->prospect_update.'</span>
                                <p class="text-gray-500 mb-0">Updated : '.$gp->created_at.'</p>
                            </div>
                        </div>
                    </div>
                    ';
                }
                $return = '<div class="timeline">'.$list.'</div>';
                return $return;
                return 'ujicoba';
            })
            ->addColumn('next_action', function ($next_action) use ($getLogs){
                $getLastAction = $getLogs->where('customer_prospect_id', $next_action->prospect_id)->first();
                return
                '
                    <span class="fw-bold d-block">'.$getLastAction->prospect_next_action.'</span>
                    <p class="text-gray-500 mb-0">'.$getLastAction->next_action_plan_date.'</p>
                ';
            })
            ->addColumn('DT_RowChecklist', function($check) use($getLogs) {
                $latest_value_in_spesific_prospect_id = $getLogs->where('customer_prospect_id', $check->prospect_id)->first();

                // Auth::user()->getRoleNames()->first() == 'administrator' &&
                if($latest_value_in_spesific_prospect_id->status == 1 && $check->user_follow_up == Auth::user()->id){
                    return '<div class="text-center w-50px"><input name="checkbox_prospect_ids" type="checkbox" value="'.$check->prospect_id.'"></div>';
                }else{
                    return '';
                }
            })
            ->addColumn('action', function ($action) use($getLogs) {
                $latest_value_in_spesific_prospect_id = $getLogs->where('customer_prospect_id', $action->prospect_id)->first();

                // Auth::user()->getRoleNames()->first() == 'administrator' &&
                if($latest_value_in_spesific_prospect_id->status == 1 && $action->user_follow_up == Auth::user()->id){
                    $mnue = '
                    <li><a href="#kt_modal_update_prospect" class="dropdown-item py-2 btn_update_prospect" data-bs-toggle="modal" data-prospectid="'.$action->prospect_id.'" data-id="'.$action->id.'"><i class="fa-solid fa-list-check me-3"></i>Update Progress</a></li>
                    ';
                }else{
                    $mnue = '
                    <li><span class="dropdown-item py-2">No Action</span></li>
                    ';
                }
                return '
                <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <ul class="dropdown-menu">
                '.$mnue.'
                </ul>
                ';
            })
            ->addIndexColumn()
            ->rawColumns(['DT_RowChecklist','customer','progress','next_action','action'])
            ->make(true);
        }
    }

    function getTableProspectDone(Request $request) : JsonResponse {
        if ($request->ajax()) {
            $query = CustomerProspect::with([
                'customer.customerContact',
                'customer.userFollowUp',
                'latestCustomerProspectLog',
                'customer.bussinesType'
            ])->whereHas('customerProspectLogs', function ($logs) {
                $logs->where('status', 2);
            })->doesntHave('itemableBillOfQuantity')->orderBy('id', 'DESC');

            return DataTables::of($query->get())
            ->addColumn('DT_RowChecklist', function($check) {
                return '<div class="text-center w-50px"><input name="checkbox_prospect_ids" type="checkbox" value="'.$check->prospect_id.'"></div>';
            })
            ->addColumn('next_action_pretified', function ($query) {
                return '
                <span class="fw-bold d-block">'.$query->latestCustomerProspectLog->prospect_next_action.'</span>
                <p class="text-gray-500 mb-0">'.$query->latestCustomerProspectLog->next_action_plan_date.'</p>
                ';
            })
            ->addColumn('progress_pretified', function ($query) {
                return '
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-line w-35px"></div>
                        <div class="timeline-icon symbol symbol-circle symbol-35px">
                            <div class="symbol-label bg-light-success">
                                <i class="fa-solid fa-check text-success"></i>
                            </div>
                        </div>
                        <div class="timeline-content">
                            <div class="pe-5">
                                <span class="fw-bold d-block">'.$query->latestCustomerProspectLog->prospect_update.'</span>
                                <p class="text-gray-500 mb-0">Updated : '.$query->latestCustomerProspectLog->created_at.'</p>
                            </div>
                        </div>
                    </div>
                </div>
                ';
            })
            ->addColumn('action', function ($query) use($request) {
                $actions = '<button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                            <ul class="dropdown-menu">
                            ';

                if ($request->filters['calledFrom'] == 'SURVEY' && $request->user()->hasPermissionTo('Survey:manage-survey-request')) {
                    $actions .= '
                    <li><a href="#kt_modal_request_survey" class="dropdown-item py-2 btn_request_survey" data-bs-toggle="modal" data-id="'.$query->id.'"><i class="fa-solid fa-list-check me-3"></i>Request Survey</a></li>
                    ';
                }

                if ($request->filters['calledFrom'] == 'BOQ' && $request->user()->hasPermissionTo('Boq:create-draft-boq')) {
                    $actions .= '<li><a href="' . url("boq/create-draft-boq?prospect_id=". $query->id) . '" class="dropdown-item py-2">
                            <i class="fa-solid fa-list-check me-3"></i>Create BoQ</a></li>
                            ';
                }

                $actions .= '</ul>';
                return $actions;
            })

            ->addIndexColumn()
            ->rawColumns(['DT_RowChecklist', 'action', 'next_action_pretified', 'progress_pretified'])
            ->make(true);
        }
    }
}
