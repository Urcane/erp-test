<?php

namespace App\Models\Opportunity\BoQ;

use App\Models\User;
use App\Models\Opportunity\BoQ\Item;
use App\Models\Customer\CustomerProspect;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Http\Requests\Opportunity\Survey\SurveyRequest;
use App\Models\Opportunity\Quotation\ItemableQuotationPart;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ItemableBillOfQuantity extends Model
{
    use HasFactory;
    protected $guarded = [];

    function itemable(): MorphMany
    {
        return $this->morphMany(Item::class, 'itemable');
    }
    
    function customerProspect() : BelongsTo {
        return $this->belongsTo(CustomerProspect::class, 'prospect_id', 'id');
    }

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

    function priceRequests() : HasMany {
        return $this->hasMany(ItemablePriceRequest::class);
    }

    function scopeDraft() : ItemableBillOfQuantity {
        return $this->where('is_draft', 1)->doesnthave('priceRequests');
    }

    function scopePublish() : ItemableBillOfQuantity {
        return $this->where('is_draft', 0)->has('priceRequests');
    }
    
    function scopeOnReview() : ItemableBillOfQuantity {
        return $this->where('is_draft', 0)->where('is_final', 1)->has('priceRequests');
    }

    function scopeDone() : ItemablePriceRequest {
        return $this->where('is_done', 1)->where(function($query) {
            $query->where('approval_manager', 1)
                  ->orWhere('approval_director', 1)
                  ->orWhere('approval_finman', 1);
        });
    }
}
