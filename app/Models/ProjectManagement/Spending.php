<?php

namespace App\Models\ProjectManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Spending extends Model
{
    use HasFactory;

    protected $guarded = [];

    function spendingable() : MorphTo {
        return $this->morphTo();
    }
}
