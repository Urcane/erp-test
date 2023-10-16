<?php

namespace App\Http\Controllers\Finance\Inventory\Masterdata;

use App\Exceptions\NotFoundError;
use App\Models\Inventory\InventoryUnitMaster;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class UnitController extends MasterdataController
{
    public function create(Request $request)
    {
        try {
            $request->validate([
                "name" => "required|string",
                "code" => "required|string|unique:inventory_unit_masters,code",
            ]);

            InventoryUnitMaster::create([
                "name" => $request->name,
                "code" => $request->code,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil menambahkan satuan baru",
            ], 201);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function update(Request $request)
    {
        try {
            $unit = InventoryUnitMaster::whereId($request->id)->first();

            if (!$unit) {
                throw new NotFoundError("Satuan tidak ditemukan");
            }

            $request->validate([
                "name" => "required|string",
                "code" => ["required", "string" , Rule::unique('inventory_unit_masters')->ignore($unit->id)],
            ]);

            $unit->update([
                "name" => $request->name,
                "code" => $request->code,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil mengubah satuan",
            ]);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function getData()
    {
        return response()->json([
            "status" => "success",
            "data" => InventoryUnitMaster::all(),
        ]);
    }

    public function getTable(Request $request)
    {
        if (request()->ajax()) {
            $query = InventoryUnitMaster::orderBy('created_at', 'desc');

            $search = $request->search;
            if ($search) {
                $query = $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('code_name', 'LIKE', '%' . $search . '%');
            }

            return DataTables::of($query)
                ->addColumn('action', function ($query) {
                    return view('finance.inventory.master-data.unit.menu', compact([
                        'query'
                    ]));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
