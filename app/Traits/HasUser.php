<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasUser
{
    function users() : BelongsToMany {
        return $this->morphToMany(User::class, 'userable', 'user_has_models');
    }
}
