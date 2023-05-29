<?php

namespace App\Http\Controllers;

use App\Models\Customer\Customer;
use App\Models\Customer\CustomerContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    public function indexLead()
    {
        return view('cmt-customer.lead.index');
    }
    
    public function storeLead(Request $request)
    {
        try {
            $company = Customer::create([
                'user_id' => Auth::user()->id,
                'customer_name' => $request->customer_name,
                'customer_bussines_type' => $request->customer_bussines_type,
                'reference_from' => $request->reference_from,
                'customer_city' => $request->customer_city,
                'customer_address' => $request->customer_address,
                'lat' => $request->lat,
                'lng' => $request->lng,
            ]);
            $contact = CustomerContact::create([
                'customer_id' => $company->id,
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
    
    public function getTableLead(Request $request)
    {  
        if (request()->ajax()) {
            $query = DB::table('customers')
            ->join('users','users.id','customers.user_id')
            ->join('customer_contacts','customer_contacts.customer_id','customers.id')
            ->select('customers.*','users.name as sales_name','customer_contacts.customer_contact_name','customer_contacts.customer_contact_phone')
            ->where('customers.deleted_at',null)
            ->orderBy('customers.id','DESC');
            
            $query = $query->get();
            return DataTables::of($query)
            ->addColumn('customer', function ($customer){
                return '
                <td>
                <span class="fw-bold d-block">'.$customer->customer_name.'</span>
                <p class="text-gray-500 mb-0">'.$customer->customer_address.'</p>
                <span class="text-gray-500">'.$customer->customer_city.'</span>
                </td>
                ';
            })
            ->addColumn('kontak', function ($kontak){
                $counter = CustomerContact::where('customer_id',$kontak->id)->count();
                if($counter > 1){
                    $mnue = '<u class="text-primary"><a href="#!" class="text-primary fs-8" data-bs-toggle="modal">Tampilan kontak lain</a></u>';
                }else{
                    $mnue = '';
                }
                return '
                <span class="mb-0 fw-bold d-block">'.$kontak->customer_contact_name.'</span>
                <span class="text-gray-500 d-block">+62'.$kontak->customer_contact_phone.'</span>
                '.$mnue.'
                ';
            })
            ->addColumn('status', function ($status){
                if($status->prospect_status == 0 && $status->customer_status == 0){
                   $badge = 'badge-light-primary';
                   $text = 'Lead'; 
                }elseif($status->prospect_status != 0 && $status->customer_status == 0){
                    $badge = 'badge-light-warning';
                   $text = 'Prospek'; 
                }else{
                    $badge = 'badge-light-success';
                   $text = 'Goal'; 
                }

                return '<span class="badge px-3 py-2 '.$badge.'">'.$text.'</span>';
            })
            ->addColumn('action', function ($action) {
                $mnue = '
                <li><a href="#!" class="dropdown-item py-2"><i class="fa-solid fa-building me-3"></i>Detail</a></li>
                <li><a href="#!" class="dropdown-item py-2"><i class="fa-solid fa-phone-volume me-3"></i>Tambah Kontak</a></li>
                ';
                return '     
                <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <ul class="dropdown-menu">
                '.$mnue.'
                </ul>
                ';
            })
            ->addColumn('DT_RowChecklist', function($check) {
                if($check->status == 1 && Auth::user()->getRoleNames()[0] == 'administrator'){
                    return '<div class="text-center w-50px"><input name="pegawai_ids" type="checkbox" value="'.$check->id.'"></div>';
                }else{
                    return '';
                }
            })
            ->addIndexColumn()
            ->rawColumns(['action','customer','kontak','status','DT_RowChecklist'])
            ->make(true);
        }
    }
}
