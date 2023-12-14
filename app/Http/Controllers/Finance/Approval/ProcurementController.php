<?php

namespace App\Http\Controllers\Finance\Approval;

use App\Http\Controllers\Controller;
use App\Models\Procurement\Procurement;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProcurementController extends Controller
{
    public function getTableApproval()
    {
        if (request()->ajax()) {
            $query = Procurement::with([

            ])->where('status', 'pending');

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
}
