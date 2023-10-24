<?php

namespace App\Http\Controllers\ProjectManagement;

use App\Http\Controllers\Controller;
use App\Models\ProjectManagement\WorkList;
use App\Services\Master\FileService;
use App\Utils\ErrorHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    protected $fileService;
    protected $errorHandler;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
        $this->errorHandler = new ErrorHandler();
    }

    public function index($work_list_id)
    {
        $workList = WorkList::whereId($work_list_id)->with("attachments")->first();
        return view('cmt-promag.pages.files', compact(["work_list_id", "workList"]));
    }

    public function createFile(Request $request, $work_list_id) {
        try{
            $request->validate([
                'file' => 'required',
            ]);
            $filename = $request->file('file')->getClientOriginalName();
            $WorkTaskAttechment = $this->fileService->storeFile(WorkList::whereId($work_list_id)->first(), [
                'file' => $request->file,
                "filePath" => "public/promag/work-lists",
                "user_id" => auth()->user()->id,
                "additional" => "promag/work_task_lists/". $work_list_id,
                'fileName' => $request->name ?? $filename,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'data' => $WorkTaskAttechment,
            ]);
        } catch (\Exception $e) {
            $data = $this->errorHandler->handle($e);
            return response()->json($data["data"], $data["code"]);
        }
    }

    public function deleteFile(Request $request, $work_list_id) {
        try{
            $workList = WorkList::whereId($work_list_id)->first()->attachments()->whereId($request->id)->first();

            Storage::delete($workList->path);
            $workList->delete();

            // remove from storage

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            $data = $this->errorHandler->handle($e);
            return response()->json($data["data"], $data["code"]);
        }
    }
}
