<?php

namespace App\Models\ProjectManagement;

use App\Models\Opportunity\Survey\SurveyRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkOrder extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $guarded = [];

    function workLists() : BelongsTo {
        return $this->belongsTo(WorkList::class);
    }

    function surveyRequests() : BelongsTo {
        return $this->belongsTo(SurveyRequest::class);
    }

    function approvedBy() : BelongsTo {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }

    function parentWorkList() : BelongsTo {
        return $this->belongsTo(this::class, 'reference_work_order', 'id');
    }

    function childWorkLists() : HasMany {
        return $this->hasMany(this::class, 'reference_work_order', 'id');
    }

    function status() : BelongsTo {
        return $this->belongsTo(WorkStatus::class, 'status', 'code');
    }

    function typeOfWO() : BelongsTo {
        return $this->belongsTo(WorkOrderCategory::class, 'type_of_wo', 'code');
    }
}
