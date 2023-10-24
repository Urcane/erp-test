<?php

namespace App\Http\Controllers\ProjectManagement;

use App\Http\Controllers\Controller;
use App\Models\ProjectManagement\WorkTaskChecklist;
use App\Models\ProjectManagement\WorkTaskComment;
use App\Models\ProjectManagement\WorkTaskList;
use App\Services\Master\FileService;
use App\Utils\ErrorHandler;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TaskListController extends Controller
{
    private $errorHandler;
    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->errorHandler = new ErrorHandler();
        $this->fileService = $fileService;
    }

    public function taskLists($work_list_id)
    {
        return view('cmt-promag.pages.task-lists', compact("work_list_id"));
    }

    public function dataTableTaskList($work_list_id) {
        $query = WorkTaskList::where("work_list_id", $work_list_id)->with('users');

        return DataTables::of($query)
            ->addColumn('assigned', function($q) {
                $users = $q->users->count();
                $result = "<div>$users</div>";

                return $result;
            })
            ->addColumn('action', function($q) {
                $route = route('com.promag.task-list.detail', ['work_list_id' => $q->work_list_id, 'task_list_id' => $q->id]);

                $result = '
                <a href="'.$route.'" class="btn_edit_karyawan dropdown-item py-2 text-success" data-id="'.$q->id.'"><i class="fa-solid fa-eye me-4"></i>Detail</a>
                ';

                return $result;
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'progress', 'assigned'])
            ->make(true);
    }

    public function store(Request $request, $work_list_id)
    {
        try{
            $request->validate([
                'task_name' => 'required',
                'start_date' => 'required',
                'due_date' => 'required',
                'task_description' => 'required',
            ]);

            WorkTaskList::create([
                "work_list_id" => $work_list_id,
                "task_name" => $request->task_name,
                "start_date" => $request->start_date,
                "due_date" => $request->due_date,
                "task_description" => $request->task_description,
                "progress_category" => "PRD",
                "status" => "PR",
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
            ]);
        } catch (\Exception $e) {
            $data = $this->errorHandler->handle($e);
            return response()->json($data["data"], $data["code"]);
        }
    }

    public function detailTaskList($work_list_id, $task_list_id)
    {
        $workTaskList = WorkTaskList::whereId($task_list_id)->with('workList', 'workTaskComment', 'attachments')->first();
        $comments = WorkTaskComment::where("work_task_list_id", $task_list_id)->orderBy('created_at', 'desc')->with('user')->paginate(10);

        return view('cmt-promag.pages.task-lists-detail', compact("work_list_id", "task_list_id", "workTaskList", "comments"));
    }

    public function addChecklist(Request $request) {
        try{
            $request->validate([
                'task_name' => 'required',
            ]);

            $WorkTaskChecklist = WorkTaskChecklist::create([
                "work_task_list_id" => $request->task_list_id,
                "task_name" => $request->task_name,
                "status" => "0",
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'data' => $WorkTaskChecklist,
            ]);
        } catch (\Exception $e) {
            $data = $this->errorHandler->handle($e);
            return response()->json($data["data"], $data["code"]);
        }
    }

    public function updateChecklist(Request $request) {

        try{
            $WorkTaskChecklist = WorkTaskChecklist::whereId($request->checklist_id)->update([
                "status" => $request->status,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'data' => $WorkTaskChecklist,
            ]);
        } catch (\Exception $e) {
            $data = $this->errorHandler->handle($e);
            return response()->json($data["data"], $data["code"]);
        }
    }

    public function createAttachment(Request $request, $task_list_id) {
        try{
            $request->validate([
                'file' => 'required',
            ]);
            $filename = $request->file('file')->getClientOriginalName();
            $WorkTaskAttechment = $this->fileService->storeFile(WorkTaskList::whereId($task_list_id)->first(), [
                'file' => $request->file,
                "filePath" => "public/promag/work-task-lists",
                "user_id" => auth()->user()->id,
                "additional" => "promag/work_task_lists/". $task_list_id,
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

    public function comment(Request $request, $task_list_id) {
        try{
            $request->validate([
                'comment' => 'required',
            ]);

            $WorkTaskComment = WorkTaskComment::create([
                "work_task_list_id" => $task_list_id,
                "user_id" => auth()->user()->id,
                "comments" => $request->comment,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'data' => $WorkTaskComment,
            ]);
        } catch (\Exception $e) {
            $data = $this->errorHandler->handle($e);
            return response()->json($data["data"], $data["code"]);
        }
    }
}
