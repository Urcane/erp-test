<?php

namespace App\Http\Controllers\Sales\Procurement;

use App\Http\Controllers\Controller;
use App\Models\Opportunity\BoQ\Item;
use App\Models\Opportunity\BoQ\ItemableBillOfQuantity;
use App\Models\Opportunity\BoQ\ItemStatus;
use App\Models\Opportunity\Quotation\ItemableQuotationPart;
use App\Models\Procurement\Procurement;
use App\Models\Procurement\ProcurementItem;
use App\Models\Procurement\ProcurementItemStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProcurementController extends Controller
{
    public function index() {
        return view("cmt-opportunity.procurement.index");
    }

    public function getTableProcurement() {
        if (request()->ajax()) {
            $query = Procurement::with("procurementItems.procurementItemStatus");

            // dd($query);
            return DataTables::of($query)
                ->addColumn('action', function ($action) {
                    return '<a href="'. route("com.procurement.detail", ['id' => $action->id]) .'" class="dropdown-item py-2 text-center px-5"><i class="fa-solid fa-eye me-3"></i>Detail</a>';
                })
                ->addColumn('status', function ($query) {
                    $status = "Done";
                    foreach ($query->procurementItems as $item) {
                        if ($item->procurementItemStatus->first()->status != "Done") {
                            $status = "On Progress";
                        }
                    }

                    return $status;
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }

    public function detailProcurement($id) {
        $procurement = Procurement::whereId($id)->first();
        $boq = ItemableBillOfQuantity::whereHas('itemable', function ($query) {
            $query->whereColumn('fulfilled', '<', 'quantity');
        })->with('itemable')->get();
        $users = User::all();

        return view("cmt-opportunity.procurement.detail-procurement", compact("procurement", "boq", "users"));
    }

    public function getTableItemProcurement(Request $request) {
        if (request()->ajax()) {
            $query = ProcurementItem::where("procurement_id", $request->filters["id"])->with('item', 'inventoryGood');

            return DataTables::of($query)
                ->addColumn('action', function ($action) {
                    $detailBoq = '
                    <div onclick="getDetail(\'' . $action->item_id . '\')">
                        <a href="#modal_detail_item" data-bs-toggle="modal" class="btn-detial dropdown-item py-2 text-center px-5 modal-item"><i class="fa-solid fa-eye me-3"></i>Detail Boq Item</a>
                    </div>
                    ';
                    $detailProquerment = '<a href="'.route("com.procurement.detail.item", ["id" => $action->id]).'" class="btn-detial dropdown-item py-2 text-center px-5 modal-item"><i class="fa-solid fa-eye me-3"></i>Detail Proqurment Item</a>';
                    return '
                    <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                    <ul class="dropdown-menu">
                    '.$detailBoq.'
                    '.$detailProquerment.'
                    </ul>
                    ';
                })
                ->addColumn('good_name', function ($query) {
                    return $query->inventoryGood->good_name;
                })
                ->addColumn('spesification', function ($query) {
                    return $query->inventoryGood->spesification ?? "-";
                })
                ->addColumn('total_price', function ($query) {
                    return $query->price + $query->shipping_price;
                })
                ->addColumn('quantity', function ($query) {
                    return $query->quantity . " " . $query->unit;
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'quantity'])
                ->make(true);
        }
    }

    public function getTableItemFromBOQ(Request $request) {
        if (request()->ajax()) {
            $query = ItemableBillOfQuantity::whereId($request->filters["id"])->with('itemable')->first()->itemable;

            return DataTables::of($query)
                ->addColumn('DT_RowChecklist', function ($check) {
                    return '<div class="text-center w-50px"><input name="item_id[]" type="checkbox" value="' . $check->id . '"></div>';
                })
                ->addColumn('action', function ($action) {
                    return '
                    <div onclick="getDetail(\'' . $action->id . '\')">
                        <a href="#modal_detail_item" data-bs-toggle="modal" class="btn-detial dropdown-item py-2 text-center px-5 modal-item"><i class="fa-solid fa-eye me-3"></i>Detail</a>
                    </div>
                    ';
                })
                ->addColumn('good_name', function ($query) {
                    return $query->inventoryGood->good_name;
                })
                ->addColumn('spesification', function ($query) {
                    return $query->inventoryGood->spesification ?? "-";
                })
                ->addColumn('quantity', function ($query) {
                    return $query->quantity . " " . $query->unit;
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'DT_RowChecklist', 'quantity'])
                ->make(true);
        }
    }

    public function getDetailItem(Request $request) {
        $item = Item::whereId($request->id)->with('inventoryGood.inventoryGoodCategory')->first();
        return response()->json([
            "status" => "success",
            "data" => $item
        ], 201);
    }

    public function storeProcurement(Request $request) {
        DB::transaction(function () use ($request) {
            $procurement = Procurement::create([
                "itemable_bill_of_quantity_id" => $request->itemable_bill_of_quantity_id,
                "type" => $request->type ?? "Customer",
                "delivery_location" => $request->delivery_location,
                "no_pr" => $request->no_pr,
                "ref_po_spk_pks" => $request->ref_po_spk_pks,
                "ref_ph" => $request->ref_ph,
                "request_date" => $request->request_date,
                "requester" => $request->requester,
                "customer" => $request->customer,
                "pic" => Auth::user()->id,
            ]);

            foreach ($request->item_id as $id) {
                $item = Item::whereId($id)->first();
                $procurementItem = ProcurementItem::create([
                    "procurement_id" => $procurement->id,
                    "item_id" => $id,
                    "inventory_good_id" => $item->inventory_good_id,
                    "quantity" => $item->quantity,
                    "unit" => $item->unit,
                    "price" => $item->purchase_price,
                    "shipping_price" => $item->purchase_delivery_charge,
                    "payment_method" => $item->payment_type,
                ]);

                ProcurementItemStatus::create([
                    "procurement_item_id" => $procurementItem->id,
                    "status" => "Create Procurement",
                    "description" => "Procurement berhasil dibuat",
                ]);
            }
        });
    }

    public function getStatusItem(Request $request) {
        return ItemStatus::where("item_id", $request->id)->get();
    }

    public function create() {
        $boq = ItemableBillOfQuantity::whereHas('itemable', function ($query) {
            $query->whereColumn('fulfilled', '<', 'quantity');
        })->with('itemable')->get();
        $users = User::all();

        return view('cmt-opportunity.procurement.form-procurement', compact("boq", "users"));
    }

    public function detailItemProcurement($id) {
        $procurementItem = ProcurementItem::whereId($id)->with("procurementItemStatus", "inventoryGood", "procurementItemPayment")->first();

        return view("cmt-opportunity.procurement.detail-item-procurement", compact("procurementItem"));
    }
}
