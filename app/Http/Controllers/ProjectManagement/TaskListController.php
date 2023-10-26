<?php

namespace App\Http\Controllers\ProjectManagement;

use App\Http\Controllers\Controller;
use App\Models\ProjectManagement\WorkActivity;
use App\Models\ProjectManagement\WorkActivityFile;
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

            $workTaskList = WorkTaskList::create([
                "work_list_id" => $work_list_id,
                "task_name" => $request->task_name,
                "start_date" => $request->start_date,
                "due_date" => $request->due_date,
                "task_description" => $request->task_description,
                "progress_category" => "PRD",
                "status" => "PR",
            ]);

            WorkActivity::create([
                "work_list_id" => $work_list_id,
                "user_id" => auth()->user()->id,
                "description" => auth()->user()->name . " added task list " . $workTaskList->task_name . " on work list " . $workTaskList->workList->work_name,
                "type" => "work_list",
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

    public function storePic(Request $request, $work_list_id)
    {
        return response()->json(['url' => "https://mantapbetul"]);
        try{
            return response()->json([
                'status' => 'success',
                'message' => $request,
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

            $workTaskChecklist = WorkTaskChecklist::create([
                "work_task_list_id" => $request->task_list_id,
                "task_name" => $request->task_name,
                "status" => "0",
            ]);

            $workTaskList = WorkTaskList::whereId($request->task_list_id)->first();

            WorkActivity::create([
                "work_list_id" => $workTaskList->work_list_id,
                "user_id" => auth()->user()->id,
                "description" => auth()->user()->name . " added checklist " . $workTaskChecklist->task_name . " on task list " . $workTaskList->task_name . " on work list " . $workTaskChecklist->workTaskList->workList->work_name,
                "type" => "task_list",
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'data' => $workTaskChecklist,
            ]);
        } catch (\Exception $e) {
            $data = $this->errorHandler->handle($e);
            return response()->json($data["data"], $data["code"]);
        }
    }

    public function updateChecklist(Request $request) {

        try{
            $workTaskChecklist = WorkTaskChecklist::whereId($request->checklist_id)->with('workTaskList.workList')->first();
            $workTaskChecklist->update([
                "status" => $request->status,
            ]);

            WorkActivity::create([
                "work_list_id" => $workTaskChecklist->workTaskList->work_list_id,
                "user_id" => auth()->user()->id,
                "description" => auth()->user()->name . " updated checklist " . $workTaskChecklist->task_name . " on work list " . $workTaskChecklist->workTaskList->workList->work_name,
                "type" => "task_list",
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'data' => $workTaskChecklist,
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
            $workTaskList = WorkTaskList::whereId($task_list_id)->with("workList")->first();

            $WorkTaskAttechment = $this->fileService->storeFile($workTaskList, [
                'file' => $request->file,
                "filePath" => "public/promag/work-task-lists",
                "user_id" => auth()->user()->id,
                "additional" => "promag/work_task_lists/". $task_list_id,
                'fileName' => $request->name ?? $filename,
            ]);

            $workActivity = WorkActivity::create([
                "work_list_id" => WorkTaskList::whereId($task_list_id)->first()->work_list_id,
                "user_id" => auth()->user()->id,
                "description" => auth()->user()->name . " uploaded file " . $WorkTaskAttechment->file_name . " on work list " . $workTaskList->workList->work_name,
                "type" => "attachment",
            ]);

            WorkActivityFile::create([
                "work_activity_id" => $workActivity->id,
                "file_id" => $WorkTaskAttechment->id,
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

            $workTaskList = WorkTaskList::whereId($task_list_id)->with("workList")->first();

            WorkActivity::create([
                "work_list_id" => WorkTaskList::whereId($task_list_id)->first()->work_list_id,
                "user_id" => auth()->user()->id,
                "description" => auth()->user()->name . " commented on task list " . $workTaskList->task_name . " on work list " . $workTaskList->workList->work_name,
                "type" => "comment",
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
