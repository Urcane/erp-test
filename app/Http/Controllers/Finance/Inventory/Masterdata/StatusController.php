<?php

namespace App\Http\Controllers\Finance\Inventory\Masterdata;

use App\Exceptions\NotFoundError;
use App\Models\Inventory\InventoryGoodStatus;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StatusController extends MasterdataController
{
    public function create(Request $request)
    {
        try {
            $request->validate([
                "name" => "required|string",
            ]);

            InventoryGoodStatus::create([
                "name" => $request->name,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil menambahkan status baru",
            ], 201);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function update(Request $request)
    {
        try {
            $status = InventoryGoodStatus::whereId($request->id)->first();

            if (!$status) {
                throw new NotFoundError("Status tidak ditemukan");
            }

            $request->validate([
                "name" => "required|string",
            ]);

            $status->update([
                "name" => $request->name,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil mengubah status",
            ]);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getData()
    {
        return response()->json([
            "status" => "success",
            "data" => InventoryGoodStatus::all(),
        ]);
    }

    public function getTable(Request $request)
    {
        if (request()->ajax()) {
            $query = InventoryGoodStatus::orderBy('created_at', 'desc');

            $search = $request->search;
            if ($search) {
                $query = $query->where('name', 'LIKE', '%' . $search . '%');
            }

            return DataTables::of($query)
                ->addColumn('action', function ($query) {
                    return view('finance.inventory.master-data.status.menu', compact([
                        'query'
                    ]));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
