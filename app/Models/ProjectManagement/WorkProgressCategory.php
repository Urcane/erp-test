<?php

namespace App\Models\ProjectManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkProgressCategory extends Model
{
    use HasFactory;

    function taskList() : HasMany {
        return $this->hasMany(TaskList::class, 'progress_category', 'code');
    }

    function workList() : HasMany {
        return $this->hasMany(WorkList::class, 'last_progress_category', 'code');
    }
}
