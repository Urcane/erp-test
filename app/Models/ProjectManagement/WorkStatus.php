<?php

namespace App\Models\ProjectManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkStatus extends Model
{
    use HasFactory;
    protected $guarded = [];

    function workList() : HasMany {
        return $this->hasMany(WorkList::class, 'progress_category', 'code');
    }

    function taskList() : HasMany {
        return $this->hasMany(WorkTaskListList::class, 'last_progress_category', 'code');
    }
}
