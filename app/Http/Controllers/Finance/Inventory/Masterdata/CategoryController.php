<?php

namespace App\Http\Controllers\Finance\Inventory\Masterdata;

use App\Exceptions\NotFoundError;
use App\Models\Inventory\InventoryGoodCategory;
use App\Utils\ErrorHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends MasterdataController
{
    public function create(Request $request)
    {
        try {
            $request->validate([
                "name" => "required|string",
                "description" => "required|string",
                "code_name" => "required|string|unique:inventory_good_categories,code_name",
            ]);

            InventoryGoodCategory::create([
                "name" => $request->name,
                "description" => $request->description,
                "code_name" => $request->code_name,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil menambahkan kategori baru",
            ], 201);
        } catch (\Throwable $th) {
            $data = ErrorHandler::handle($th);

            return response()->json($data["data"], $data["code"]);
        }
    }

    public function update(Request $request)
    {
        try {
            $category = InventoryGoodCategory::whereId($request->id)->first();

            if (!$category) {
                throw new NotFoundError("Kategori tidak ditemukan");
            }

            $request->validate([
                "name" => "required|string",
                "description" => "required|string",
                "code_name" => ["required", "string" , Rule::unique('inventory_good_categories')->ignore($category->id)],
            ]);

            $category->update([
                "name" => $request->name,
                "description" => $request->description,
                "code_name" => $request->code_name,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil mengubah kategori",
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
            "data" => InventoryGoodCategory::all()
        ]);
    }

    public function getTable(Request $request)
    {
        if (request()->ajax()) {
            $query = InventoryGoodCategory::orderBy('created_at', 'desc');

            $search = $request->search;
            if ($search) {
                $query = $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('code_name', 'LIKE', '%' . $search . '%');
            }

            return DataTables::of($query)
                ->addColumn('action', function ($query) {
                    return view('finance.inventory.master-data.category.menu', compact([
                        'query'
                    ]));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
