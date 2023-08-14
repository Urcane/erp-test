<?php

namespace App\Traits;

use App\Models\Master\File;
use App\Models\ProjectManagement\TaskList;
use App\Models\ProjectManagement\WorkList;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasFile
{
    function attachments() : MorphMany {
        return $this->morphMany(File::class, 'fileable');
    }

    function attachment() : MorphOne {
        return $this->morphOne(File::class, 'fileable');
    }
}
