<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubBranch extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function userEmployments(): HasMany {
        return $this->hasMany(UserEmployment::class);
    }

    public function branch() : Belangsto {
        return $this->belongsTo(Branch::class);
    }

    public function parent() : Belangsto {
        return $this->belongsTo(SubBranch::class, "parent_id");
    }

    public function child() : HasMany {
        return $this->hasMany(SubBranch::class, "parent_id");
    }
}