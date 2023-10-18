<?php

namespace App\Models\ProjectManagement;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Client\Request;

class WorkList extends Model
{
    use HasFactory, HasUser;
    protected $guarded = [];

    function workAttachment() : HasMany {
        return $this->hasMany(WorkAttachment::class);
    }

    function projectProgressCategory() : BelongsTo {
        return $this->belongsTo(WorkProgressCategory::class);
    }

    function projectStatus() : BelongsTo {
        return $this->belongsTo(WorkStatus::class);
    }

    function createTask(Request $request) : WorkList {
        return $this;
    }

    function itemablePriceRequest() : HasOne{
        return $this->hasOne(ItemablePriceRequests::class, 'work_list_id', 'id');
    }
}
