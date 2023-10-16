<?php

namespace App\Http\Controllers\Finance\Inventory;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Models\Inventory\InventoryGood;
use App\Models\Inventory\InventoryGoodCondition;
use App\Models\Inventory\InventoryGoodStatus;
use App\Models\Inventory\InventoryUnitMaster;
use App\Models\Inventory\Warehouse;
use App\Models\Inventory\WarehouseGood;
use App\Utils\ErrorHandler;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InventoryController extends Controller
{
    private $errorHandler;
    private $constants;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
        $this->constants = new Constants();
    }

    public function viewDashboard()
    {
        return view('finance.inventory.dashboard');
    }

    public function viewInventory()
    {
        $warehouses = Warehouse::all();

        return view('finance.inventory.inventory', compact([
            'warehouses'
        ]));
    }

    public function viewMasterData()
    {
        return view('finance.inventory.master-data.index');
    }

    public function viewAddItem()
    {
        $warehouses = Warehouse::all();
        $items = InventoryGood::with('inventoryGoodCategory')->get();
        $units = InventoryUnitMaster::all();
        $conditions = InventoryGoodCondition::all();
        $statuses = InventoryGoodStatus::all();

        return view('finance.inventory.add-item', compact([
            'warehouses', 'items', 'units', 'conditions', 'statuses'
        ]));
    }

    public function storeItem(Request $request)
    {
        try {
            $request->validate([
                'serial_number' => 'string|nullable',
                'warehouse_id' => 'required|exists:warehouses,id',
                'inventory_good_id' => 'required|exists:inventory_goods,id',
                'inventory_unit_master_id' => 'required|exists:inventory_unit_masters,id',
                'inventory_good_condition_id' => 'required|exists:inventory_good_conditions,id',
                'inventory_good_status_id' => 'required|exists:inventory_good_statuses,id',
                'stock' => 'required|integer',
                'minimum_stock' => 'required|integer',
            ]);

            WarehouseGood::create([
                'serial_number' => $request->serial_number,
                'warehouse_id' => $request->warehouse_id,
                'inventory_good_id' => $request->inventory_good_id,
                'inventory_unit_master_id' => $request->inventory_unit_master_id,
                'inventory_good_condition_id' => $request->inventory_good_condition_id,
                'inventory_good_status_id' => $request->inventory_good_status_id,
                'stock' => $request->stock,
                'minimum_stock' => $request->minimum_stock,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil menambahkan item',
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getTableInventory(Request $request)
    {
        if (request()->ajax()) {
            $query = WarehouseGood::with(['inventoryGood.inventoryGoodCategory', 'inventoryUnitMaster']);

            $filterWarehouse = $request->filterWarehouse;
            if ($filterWarehouse !== "*") {
                $query = $query->where('warehouse_id', $filterWarehouse);
            }

            $search = $request->search;
            if ($search) {
                $query = $query->where(function ($query) use ($search) {
                    $query->where('serial_number', 'LIKE', '%' . $search . '%')
                        ->orWhere('stock', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('inventoryGood', function ($query) use ($search) {
                            $query->where('good_name', 'LIKE', '%' . $search . '%')
                                ->orWhere('code_name', 'LIKE', '%' . $search . '%');
                        })
                        ->orWhereHas('inventoryGood.inventoryGoodCategory', function ($query) use ($search) {
                            $query->where('name', 'LIKE', '%' . $search . '%');
                        });
                });
            }

            return DataTables::of($query)
                ->addColumn('category', function ($query) {
                    return $query->inventoryGood->inventoryGoodCategory->name;
                })
                ->addColumn('name', function ($query) {
                    return $query->inventoryGood->good_name . " - " . $query->inventoryGood->code_name;
                })
                ->addColumn('stock', function ($query) {
                    return $query->stock . " " . $query->inventoryUnitMaster->name;
                })
                ->addColumn('action', function ($query) {
                    return "-";
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
