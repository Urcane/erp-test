<?php

namespace App\Models\Assignment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignmentWorkSchedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function assignment(): BelongsTo
    {
        return $this->belongsTo(Assignment::class);
    }
}
