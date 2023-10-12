<?php

namespace App\Http\Controllers\Finance\Inventory;

use App\Constants;
use App\Http\Controllers\Controller;
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
        return view('finance.inventory.inventory');
    }

    public function viewMasterData()
    {
        return view('finance.inventory.master-data.index');
    }

    public function viewAddItem()
    {
        return view('finance.inventory.add-item');
    }

    public function storeItem()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getTableInventory()
    {
        if (request()->ajax()) {


            return DataTables::of()
                ->addColumn('DT_RowChecklist', function ($check) {
                    return;
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'DT_RowChecklist'])
                ->make(true);
        }
    }
}
