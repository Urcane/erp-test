<?php

namespace App\Models\Opportunity\BoQ;

use App\Models\User;
use App\Models\Opportunity\BoQ\Items;
use App\Models\Customer\CustomerProspect;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Http\Requests\Opportunity\Survey\SurveyRequest;

class ItemableBillOfQuantity extends Model
{
    use HasFactory;
    protected $guarded = [];

    function itemableBillOfQuantity() : MorphMany{
        return $this->morphMany(Item::class, 'itemable','itemable_type', 'itemable_id');
    }

    function itemableBillOfQuantityLog() : HasOne{
        return $this->hasOne(ItemableBillOfQuantityLog::class, 'id', 'itemable_bill_of_quantity_id');
    }
    
    // public function items(): MorphMany
    // {
    //     // Mengembalikan hasil relasi "MorphMany" dengan model "Items"
    //     // 'itemable_id' dan 'itemable_type' adalah kolom yang digunakan
    //     // untuk mengidentifikasi polimorfik relasi pada tabel "items"
    //     return $this->morphMany(Items::class, 'itemable', 'itemable_type', 'itemable_id');
    // }

    function prospect() : BelongsTo {
        return $this->belongsTo(CustomerProspect::class, 'prospect_id', 'id');
    }

    function surveyRequest() : BelongsTo {
        return $this->belongsTo(SurveyRequest::class, 'survey_request_id', 'id');
    }

    function sales() : BelongsTo {
        return $this->belongsTo(User::class, 'sales_id');
    }

    function technician() : BelongsTo {
        return $this->belongsTo(User::class, 'technician_id');
    }

    function procurement() : BelongsTo {
        return $this->belongsTo(User::class, 'procurement_id');
    }

    function parentItemableBillOfQuantity() : BelongsTo{
        return $this->belongsTo(this::class, 'reference_bill_of_quantity_id', 'id');
    }

    function childItemableBillOfQuantity() : HasOne{
        return $this->hasOne(this::class, 'reference_bill_of_quantity_id', 'id');
    }
}
