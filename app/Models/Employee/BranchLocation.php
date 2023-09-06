<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BranchLocation extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function subBranch(): BelongsTo
    {
        return $this->belongsTo(SubBranch::class);
    }
}
