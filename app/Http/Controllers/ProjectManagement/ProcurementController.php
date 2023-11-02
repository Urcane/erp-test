<?php

namespace App\Http\Controllers\ProjectManagement;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Models\Inventory\Warehouse;
use App\Models\Opportunity\BoQ\ItemableBillOfQuantity;
use App\Models\Procurement\Procurement;
use App\Models\ProjectManagement\WorkList;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProcurementController extends Controller
{
    private $constants;

    public function __construct()
    {
        $this->constants = new Constants();
    }

    public function index($work_list_id)
    {
        return view('cmt-promag.pages.procurement', compact('work_list_id'));
    }

    public function dataTableProcurement($work_list_id)
    {
        if (request()->ajax()) {
            $query = Procurement::where("work_list_id", $work_list_id)->with("procurementItems.procurementItemStatus");

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

    public function create(WorkList $workList){
        $boq = ItemableBillOfQuantity::whereHas('itemable', function ($query) {
            $query->whereColumn('fulfilled', '<', 'quantity');
        })->whereId($workList->itemable_bill_of_quantity_id)->with('itemable')->get();
        $users = User::all();
        $dataProcurementType = $this->constants->procurement_type;
        $dataWarehouse = Warehouse::all();

        return view('finance.procurement.form-procurement', compact("boq", "users", "workList", "dataProcurementType", "dataWarehouse"));
    }
}
