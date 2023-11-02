<?php

namespace App\Http\Controllers\Finance\Approval;

use App\Http\Controllers\Controller;
use App\Models\Master\Payment;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SpendingController extends Controller
{
    public function getTableApproval()
    {
        if (request()->ajax()) {
            $query = Payment::with([
                // 'inventoryGood',
                // 'inventoryGood.inventoryGoodCategory',
                // 'warehouse'
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
