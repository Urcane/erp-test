<?php

namespace App\Models\ProjectManagement;

use App\Traits\HasUser;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskList extends Model
{
    use HasFactory, HasUser;
    
    function workAttachment() : HasMany {
        return $this->hasMany(WorkAttachment::class);
    }

    function workComment() : HasMany {
        return $this->hasMany(WorkComment::class);
    }

    function workChecklist() : HasMany {
        return $this->hasMany(WorkChecklist::class);
    }

    function projectProgressCategory() : BelongsTo {
        return $this->belongsTo(WorkProgressCategory::class);
    }

    function projectStatus() : BelongsTo {
        return $this->belongsTo(WorkStatus::class);
    }

    function createTask($item) : TaskList {
        $worklist = $this->create([
            'work_name' => $item->work_name,
            'work_description' => $item->work_description,
            'progress_category' => $item->progress_category,
        ]);

        return $worklist;
    }
}