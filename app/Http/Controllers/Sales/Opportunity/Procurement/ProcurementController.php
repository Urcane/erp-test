<?php

namespace App\Http\Controllers\Sales\Opportunity\Procurement;

use App\Http\Controllers\Controller;
use App\Models\Opportunity\BoQ\ItemableBillOfQuantity;
use App\Models\Opportunity\BoQ\ItemStatus;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProcurementController extends Controller
{
    public function index() {
        return view("cmt-opportunity.procurement.index");
    }

    public function getTableProcurement() {
        if (request()->ajax()) {
            $query = ItemableBillOfQuantity::where("is_done", 1)->with('customerProspect.customer');

            // dd($query);
            return DataTables::of($query)
                ->addColumn('action', function ($action) {
                    return '<a href="'. route("com.procurement.detail", ['id' => $action->id]) .'" class="dropdown-item py-2 text-center px-5"><i class="fa-solid fa-eye me-3"></i>Detail</a>';
                })
                ->addColumn('customer_name', function ($query) {
                    return $query->customerProspect->customer->customer_name;
                })
                ->addColumn('customer_address', function ($query) {
                    return $query->customerProspect->customer->customer_address;
                })
                ->addColumn('total_items', function ($query) {
                    return $query->itemable->count();
                })
                ->addColumn('prospect_title', function ($query) {
                    return $query->customerProspect->prospect_title;
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'customer_name'])
                ->make(true);
        }
    }

    public function detailProcurement($id) {
        $boq = ItemableBillOfQuantity::whereId($id)->with("itemable", "customerProspect", "sales", "procurement", "surveyRequest")->first();

        return view("cmt-opportunity.procurement.detail-procurement", compact("boq"));
    }

    public function getTableItem($id) {
        if (request()->ajax()) {
            $query = ItemableBillOfQuantity::whereId($id)->with('itemable')->first()->itemable;

            // dd($query);
            return DataTables::of($query)
                ->addColumn('action', function ($action) {
                    return '
                    <div onclick="getStatus(\'' . $action->id . '\')">
                        <a href="#modal_status_item" data-bs-toggle="modal" class="dropdown-item py-2 text-center px-5 modal-item"><i class="fa-solid fa-eye me-3"></i>Status</a>
                    </div>
                    ';
                })
                ->addColumn('quantity', function ($query) {
                    return $query->quantity . " " . $query->unit;
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getStatusItem(Request $request) {
        return ItemStatus::where("item_id", $request->id)->get();
    }
}
