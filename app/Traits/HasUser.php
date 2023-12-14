<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasUser
{
    function users() : MorphToMany {
        return $this->morphToMany(User::class, 'userable', 'user_has_models');
    }
}
