<?php

namespace App\Http\Controllers\Finance\Inventory\Masterdata;

use App\Exceptions\NotFoundError;
use App\Models\Inventory\InventoryGoodCondition;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ConditionController extends MasterdataController
{
    public function create(Request $request)
    {
        try {
            $request->validate([
                "name" => "required|string",
            ]);

            InventoryGoodCondition::create([
                "name" => $request->name,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil menambahkan kondisi baru",
            ], 201);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function update(Request $request)
    {
        try {
            $condition = InventoryGoodCondition::whereId($request->id)->first();

            if (!$condition) {
                throw new NotFoundError("Kondisi tidak ditemukan");
            }

            $request->validate([
                "name" => "required|string",
            ]);

            $condition->update([
                "name" => $request->name,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil mengubah kondisi",
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
            "data" => InventoryGoodCondition::all()
        ]);
    }

    public function getTable(Request $request)
    {
        if (request()->ajax()) {
            $query = InventoryGoodCondition::orderBy('created_at', 'desc');

            $search = $request->search;
            if ($search) {
                $query = $query->where('name', 'LIKE', '%' . $search . '%');
            }

            return DataTables::of($query)
                ->addColumn('action', function ($query) {
                    return view('finance.inventory.master-data.condition.menu', compact([
                        'query'
                    ]));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
