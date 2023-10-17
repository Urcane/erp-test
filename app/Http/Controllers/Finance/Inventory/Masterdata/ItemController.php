<?php

namespace App\Http\Controllers\Finance\Inventory\Masterdata;

use App\Exceptions\NotFoundError;
use App\Models\Inventory\InventoryGood;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ItemController extends MasterdataController
{
    public function create(Request $request)
    {
        try {
            $request->validate([
                'good_category_id' => 'required|exists:inventory_good_categories,id',
                'good_name' => 'required|string',
                'good_type' => 'nullable|string',
                'code_name' => 'required|string',
                'spesification' => 'nullable|string',
                'merk' => 'nullable|string',
                'description' => 'nullable|string',
            ]);

            InventoryGood::create([
                'good_category_id' => $request->good_category_id,
                'good_name' => $request->good_name,
                'good_type' => $request->good_type,
                'code_name' => $request->code_name,
                'spesification' => $request->spesification,
                'merk' => $request->merk,
                'description' => $request->description,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil menambahkan barang baru",
            ], 201);
        } catch (\Throwable $th) {
            $data = $this->errorHandler->handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function update(Request $request)
    {
        try {
            $item = InventoryGood::whereId($request->id)->first();

            if (!$item) {
                throw new NotFoundError("Barang tidak ditemukan");
            }

            $request->validate([
                'good_category_id' => 'required|exists:inventory_good_categories,id',
                'good_name' => 'required|string',
                'good_type' => 'nullable|string',
                'code_name' => 'required|string',
                'spesification' => 'nullable|string',
                'merk' => 'nullable|string',
                'description' => 'nullable|string',
            ]);

            $item->update([
                'good_category_id' => $request->good_category_id,
                'good_name' => $request->good_name,
                'good_type' => $request->good_type,
                'code_name' => $request->code_name,
                'spesification' => $request->spesification,
                'merk' => $request->merk,
                'description' => $request->description,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil mengubah barang",
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
            "data" => InventoryGood::with(['inventoryGoodCategory'])->get()
        ]);
    }

    public function getTable(Request $request)
    {
        if (request()->ajax()) {
            $query = InventoryGood::orderBy('created_at', 'desc')->with(['inventoryGoodCategory']);

            $search = $request->search;
            if ($search) {
                $query = $query->where(function ($query) use ($search) {
                    $query->whereHas('inventoryGoodCategory', function ($query) use ($search) {
                        $query->where('name', 'LIKE', '%' . $search . '%');
                    })
                        ->orwhere('good_name', 'LIKE', '%' . $search . '%')
                        ->orWhere('code_name', 'LIKE', '%' . $search . '%')
                        ->orWhere('merk', 'LIKE', '%' . $search . '%');
                });
            }

            return DataTables::of($query)
                ->addColumn('category', function ($query) {
                    return $query->inventoryGoodCategory->name;
                })
                ->addColumn('action', function ($query) {
                    return view('finance.inventory.master-data.item.menu', compact([
                        'query'
                    ]));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
