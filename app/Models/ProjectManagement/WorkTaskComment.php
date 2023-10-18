<?php

namespace App\Models\ProjectManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkTaskComment extends Model
{
    use HasFactory;
    protected $guarded = [];

    function TaskList() : BelongsTo {
        return $this->belongsTo(WorkTaskList::class);
    }
}
