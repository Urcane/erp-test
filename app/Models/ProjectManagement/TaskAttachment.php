<?php

namespace App\Models\ProjectManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkAttachment extends Model
{
    use HasFactory;

    function workList() : BelongsTo {
        return $this->belongsTo(WorkList::class);
    }

    function taskList() : BelongsTo {
        return $this->belongsTo(TaskList::class);
    }
}
