<?php

namespace App\Http\Controllers\Finance\Inventory\Masterdata;

use App\Exceptions\NotFoundError;
use App\Models\Inventory\Warehouse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WarehouseController extends MasterdataController
{
    public function create(Request $request)
    {
        try {
            $request->validate([
                "name" => "required|string",
                "latitude" => "nullable|string",
                "longitude" => "nullable|string",
            ]);

            Warehouse::create([
                "name" => $request->name,
                "latitude" => $request->latitude,
                "longitude" => $request->longitude,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil menambahkan gudang baru",
            ], 201);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function update(Request $request)
    {
        try {
            $warehouse = Warehouse::whereId($request->id)->first();

            if (!$warehouse) {
                throw new NotFoundError("Gudang tidak ditemukan");
            }

            $request->validate([
                "name" => "required|string",
                "latitude" => "nullable|string",
                "longitude" => "nullable|string",
            ]);

            $warehouse->update([
                "name" => $request->name,
                "latitude" => $request->latitude,
                "longitude" => $request->longitude,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil mengubah data gudang",
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
            "data" => Warehouse::all(),
        ]);
    }

    public function getTable(Request $request)
    {
        if (request()->ajax()) {
            $query = Warehouse::orderBy('created_at', 'desc');

            $search = $request->search;
            if ($search) {
                $query = $query->where('name', 'LIKE', '%' . $search . '%');
            }

            return DataTables::of($query)
                ->addColumn('action', function ($query) {
                    return view('finance.inventory.master-data.warehouse.menu', compact([
                        'query'
                    ]));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
