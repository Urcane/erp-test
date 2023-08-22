<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BranchLocation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subBranch(): BelongsTo
    {
        return $this->belongsTo(SubBranch::class);
    }
}
