<?php

namespace App\Models\ProjectManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkOrderCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    function workOrders() : HasMany {
        return $this->hasMany(WorkOrder::class, 'type_of_wo', 'code');
    }
}
