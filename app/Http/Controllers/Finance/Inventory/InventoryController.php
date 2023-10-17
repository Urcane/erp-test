<?php

namespace App\Http\Controllers\Finance\Inventory;

use App\Constants;
use App\Exceptions\InvariantError;
use App\Http\Controllers\Controller;
use App\Models\Inventory\InventoryGood;
use App\Models\Inventory\InventoryGoodCondition;
use App\Models\Inventory\InventoryGoodStatus;
use App\Models\Inventory\InventoryUnitMaster;
use App\Models\Inventory\Warehouse;
use App\Models\Inventory\WarehouseGood;
use App\Utils\ErrorHandler;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $warehouseCount = Warehouse::count();
        $stocks = WarehouseGood::select(DB::raw('COUNT(CASE WHEN total_stock >= minimum_stock THEN 1 END) as availableStock, COUNT(CASE WHEN total_stock < minimum_stock AND total_stock > 0 THEN 1 END) as lowStock, COUNT(CASE WHEN total_stock = 0 THEN 1 END) as outOfStock'))
            ->leftJoin(DB::raw('(SELECT warehouse_good_id, SUM(stock) as total_stock FROM warehouse_good_stocks GROUP BY warehouse_good_id) as stocks'), 'warehouse_goods.id', '=', 'stocks.warehouse_good_id')
            ->first();

        return view('finance.inventory.dashboard', compact([
            'warehouseCount', 'stocks'
        ]));
    }

    public function viewInventory()
    {
        $warehouses = Warehouse::all();

        return view('finance.inventory.inventory.index', compact([
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

        return view('finance.inventory.add-item.index', compact([
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
                'inventory_good_condition_id' => 'required|array',
                'inventory_good_status_id' => 'required|array',
                'stock' => 'required|array',
                'minimum_stock' => 'required|integer',
            ], [
                'stock.required' => 'Tambahkan Item Stock pada gudang!',
                'inventory_good_condition_id.required' => 'Tambahkan Item Stock pada gudang!',
                'inventory_good_status_id.required' => 'Tambahkan Item Stock pada gudang!',
            ]);

            $warehouseGood = WarehouseGood::where('inventory_good_id', $request->inventory_good_id)
                ->where('warehouse_id', $request->warehouse_id)
                ->first();

            if ($warehouseGood) {
                throw new InvariantError('Item sudah ada di gudang ini');
            }

            DB::beginTransaction();

            $warehouseGood = WarehouseGood::create([
                'serial_number' => $request->serial_number,
                'warehouse_id' => $request->warehouse_id,
                'inventory_unit_master_id' => $request->inventory_unit_master_id,
                'inventory_good_id' => $request->inventory_good_id,
                'minimum_stock' => $request->minimum_stock,
            ]);

            foreach ($request->stock as $key => $stock) {
                $warehouseGood->warehouseGoodStocks()->create([
                    'inventory_good_condition_id' => $request->inventory_good_condition_id[$key],
                    'inventory_good_status_id' => $request->inventory_good_status_id[$key],
                    'stock' => $stock,
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil menambahkan item',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            if ($th instanceof QueryException && $th->errorInfo[1] === 1062) {
                $data = $this->errorHandler->handle(new InvariantError('Dilarang memasukan stock dengan kondisi dan status yang sama lebih dari satu kali'));

                return response()->json($data["data"], $data["code"]);
            }

            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getTableInventory(Request $request)
    {
        if (request()->ajax()) {
            $query = WarehouseGood::with([
                'inventoryGood.inventoryGoodCategory',
                'inventoryUnitMaster',
                'warehouseGoodStocks',
                'warehouse'
            ]);

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
                ->addColumn('code', function ($query) {
                    return $query->inventoryGood->code_name;
                })
                ->addColumn('category', function ($query) {
                    return $query->inventoryGood->inventoryGoodCategory->name;
                })
                ->addColumn('item_name', function ($query) {
                    return $query->inventoryGood->good_name;
                })
                ->addColumn('warehouse_name', function ($query) {
                    return $query->warehouse->name;
                })
                ->addColumn('stock', function ($query) {
                    return $query->warehouseGoodStocks->sum('stock') . " " . $query->inventoryUnitMaster->name;
                })
                ->addColumn('action', function ($query) {
                    return view('finance.inventory.inventory.menu', compact([
                        'query'
                    ]));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
