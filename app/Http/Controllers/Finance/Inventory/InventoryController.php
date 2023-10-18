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
use App\Models\Inventory\WarehouseGoodStock;
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

        $stocks = WarehouseGoodStock::select(DB::raw('
            COUNT(CASE WHEN stock >= minimum_stock THEN 1 END) as availableStock,
            COUNT(CASE WHEN stock < minimum_stock AND stock > 0 THEN 1 END) as lowStock,
            COUNT(CASE WHEN stock = 0 THEN 1 END) as outOfStock'
        ))->first();

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

    public function viewTransferItem()
    {
        $warehouses = Warehouse::all();

        return view('finance.inventory.transfer-item.index', compact([
            'warehouses'
        ]));
    }

    public function storeItem(Request $request)
    {
        try {
            $request->validate([
                'serial_number' => 'nullable|array',
                'warehouse_id' => 'required|exists:warehouses,id',
                'inventory_good_id' => 'required|exists:inventory_goods,id',
                'inventory_unit_master_id' => 'required|array',
                'inventory_good_condition_id' => 'required|array',
                'inventory_good_status_id' => 'required|array',
                'stock' => 'required|array',
                'minimum_stock' => 'required|array',
            ], [
                'stock.required' => 'Tambahkan Item Stock pada gudang!',
                'inventory_good_condition_id.required' => 'Tambahkan Item Stock pada gudang!',
                'inventory_good_status_id.required' => 'Tambahkan Item Stock pada gudang!',
                'inventory_unit_master_id.required' => 'Tambahkan Item Stock pada gudang!',
                'minimum_stock.required' => 'Tambahkan Item Stock pada gudang!',
            ]);

            $warehouseGood = WarehouseGood::where('inventory_good_id', $request->inventory_good_id)
                ->where('warehouse_id', $request->warehouse_id)
                ->first();

            if ($warehouseGood) {
                throw new InvariantError('Item sudah ada di gudang ini');
            }

            DB::beginTransaction();

            $warehouseGood = WarehouseGood::create([
                'warehouse_id' => $request->warehouse_id,
                'inventory_good_id' => $request->inventory_good_id,
            ]);

            foreach ($request->stock as $key => $stock) {
                $warehouseGood->warehouseGoodStocks()->create([
                    'serial_number' => $request->serial_number[$key],
                    'inventory_good_condition_id' => $request->inventory_good_condition_id[$key],
                    'inventory_good_status_id' => $request->inventory_good_status_id[$key],
                    'inventory_unit_master_id' => $request->inventory_unit_master_id[$key],
                    'minimum_stock' => $request->minimum_stock[$key],
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
                $data = $this->errorHandler->handle(new InvariantError('Dilarang memasukan stock dengan unit, kondisi dan status yang sama lebih dari satu kali'));

                return response()->json($data["data"], $data["code"]);
            }

            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function transferItem(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'warehouse_id' => 'required|exists:warehouses,id',
                'transfer_warehouse_id' => 'required|exists:warehouses,id',
                'warehouse_good_stock_id' => 'required|array',
                'stock' => 'required|array',
            ], [
                'warehouse_good_stock_id.required' => 'Tambahkan Item yang ingin ditransfer!',
                'stock.required' => 'Tambahkan Item yang ingin ditransfer!',
            ]);

            if ($request->warehouse_id == $request->transfer_warehouse_id) {
                throw new InvariantError('Gudang asal dan tujuan tidak boleh sama');
            }

            DB::beginTransaction();

            $sender = Warehouse::whereId($request->warehouse_id)->first();
            $receiver = Warehouse::whereId($request->transfer_warehouse_id)->first();

            $senderLog = $sender->warehouseLogs()->create([
                'name' => $request->name,
                'status' => $this->constants->inventory_status[1],
            ]);

            $receiverLog = $receiver->warehouseLogs()->create([
                'name' => $request->name,
                'status' => $this->constants->inventory_status[1],
            ]);

            foreach ($request->warehouse_good_stock_id as $key => $warehouseGoodStockId) {
                $warehouseGoodStock = WarehouseGoodStock::whereId($warehouseGoodStockId)
                    ->whereHas('warehouseGood', function ($query) use ($request) {
                        $query->where('warehouse_id', $request->warehouse_id);
                    })->with('warehouseGood')->first();

                if ($warehouseGoodStock->stock < $request->stock[$key]) {
                    throw new InvariantError('Stock tidak mencukupi');
                }

                $warehouseGoodStock->update([
                    'stock' => $warehouseGoodStock->stock - $request->stock[$key]
                ]);

                $warehouseGood = $receiver
                    ->warehouseGood()
                    ->where('inventory_good_id', $warehouseGoodStock->warehouseGood->inventory_good_id)->first();

                if (!$warehouseGood) {
                    $warehouseGood = $receiver->warehouseGood()->create([
                        'inventory_good_id' => $warehouseGoodStock->warehouseGood->inventory_good_id,
                    ]);
                }

                $warehouseGood->warehouseGoodStocks()->updateOrCreate([
                    'minimum_stock' => 0,
                    'stock' => $request->stock[$key],
                ], [
                    'inventory_good_condition_id' => $warehouseGoodStock->inventory_good_condition_id,
                    'inventory_good_status_id' => $warehouseGoodStock->inventory_good_status_id,
                    'inventory_unit_master_id' => $warehouseGoodStock->inventory_unit_master_id,
                ]);

                $senderGoodLog = $senderLog->warehouseGoodLogs()->create([
                    'inventory_good_id' => $warehouseGoodStock->warehouseGood->inventory_good_id,
                ]);

                $senderGoodLog->warehouseGoodStockLogs()->create([
                    'inventory_good_condition_id' => $warehouseGoodStock->inventory_good_condition_id,
                    'inventory_good_status_id' => $warehouseGoodStock->inventory_good_status_id,
                    'inventory_unit_master_id' => $warehouseGoodStock->inventory_unit_master_id,
                    'stock' => -$request->stock[$key],
                ]);

                $receiverGoodLog = $receiverLog->warehouseGoodLogs()->create([
                    'inventory_good_id' => $warehouseGoodStock->warehouseGood->inventory_good_id,
                ]);

                $receiverGoodLog->warehouseGoodStockLogs()->create([
                    'inventory_good_condition_id' => $warehouseGoodStock->inventory_good_condition_id,
                    'inventory_good_status_id' => $warehouseGoodStock->inventory_good_status_id,
                    'inventory_unit_master_id' => $warehouseGoodStock->inventory_unit_master_id,
                    'stock' => $request->stock[$key],
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil memindahkan barang',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getTableInventory(Request $request)
    {
        if (request()->ajax()) {
            $query = WarehouseGood::with([
                'inventoryGood.inventoryGoodCategory',
                'warehouse'
            ]);

            $filterWarehouse = $request->filterWarehouse;
            if ($filterWarehouse !== "*") {
                $query = $query->where('warehouse_id', $filterWarehouse);
            }

            $search = $request->search;
            if ($search) {
                $query = $query->where(function ($query) use ($search) {
                    $query->whereHas('inventoryGood', function ($query) use ($search) {
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

    public function getTableTransferItem(Request $request)
    {
        if (request()->ajax()) {
            $query = WarehouseGoodStock::whereHas('warehouseGood', function ($query) use ($request) {
                $query->where('warehouse_id', $request->warehouse_id);
            })->with([
                'warehouseGood.inventoryGood.inventoryGoodCategory',
                'warehouseGood.warehouse',
                'inventoryGoodCondition',
                'inventoryGoodStatus',
                'inventoryUnitMaster'
            ]);

            $items = $request->items;
            if ($items) {
                $query = $query->whereNotIn('id', $items);
            }

            return DataTables::of($query)
                ->addColumn('item_name', function ($query) {
                    return $query->warehouseGood->inventoryGood->good_name;
                })
                ->addColumn('category', function ($query) {
                    return $query->warehouseGood->inventoryGood->inventoryGoodCategory->name;
                })
                ->addColumn('stock', function ($query) {
                    return $query->stock;
                })
                ->addColumn('unit', function ($query) {
                    return $query->inventoryUnitMaster->name;
                })
                ->addColumn('condition', function ($query) {
                    return $query->inventoryGoodCondition->name;
                })
                ->addColumn('status', function ($query) {
                    return $query->inventoryGoodStatus->name;
                })
                ->addColumn('action', function ($query) {
                    return view('finance.inventory.transfer-item.menu', compact([
                        'query'
                    ]));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
