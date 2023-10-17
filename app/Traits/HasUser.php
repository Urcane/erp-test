<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasUser
{
    function users() : MorphMany {
        return $this->morphToMany(User::class, 'userable', 'user_has_models');
    }
}
