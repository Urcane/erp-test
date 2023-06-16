<?php

namespace App\Traits;

use App\Models\ProjectManagement\TaskList;
use App\Models\ProjectManagement\WorkList;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasProject
{
    function workLists() : BelongsToMany {
        return $this->morphedByMany(WorkList::class, 'userable', 'user_has_models');
    }

    function taskLists() : BelongsToMany {
        return $this->morphedByMany(TaskList::class, 'userable', 'user_has_models');
    }
}
