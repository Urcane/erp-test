<?php

namespace App\Models\ProjectManagement;

use App\Traits\HasFile;
use App\Traits\HasUser;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkTaskList extends Model
{
    use HasFactory, HasUser, HasFile;
    protected $guarded = [];

    function workTaskComment() : HasMany {
        return $this->hasMany(WorkTaskComment::class);
    }

    function workTaskChecklist() : HasMany {
        return $this->hasMany(WorkTaskChecklist::class);
    }

    function projectProgressCategory() : BelongsTo {
        return $this->belongsTo(WorkProgressCategory::class);
    }

    function workList() : BelongsTo {
        return $this->belongsTo(WorkList::class);
    }

    function projectStatus() : BelongsTo {
        return $this->belongsTo(WorkStatus::class);
    }

    function createTask($item) : WorkTaskList {
        $worklist = $this->create([
            'work_name' => $item->work_name,
            'work_description' => $item->work_description,
            'progress_category' => $item->progress_category,
        ]);

        return $worklist;
    }
}
