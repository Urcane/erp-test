<?php

namespace App\Models\Opportunity\BoQ;

use App\Models\User;
use App\Models\Opportunity\BoQ\Item;
use Illuminate\Database\Eloquent\Model;

use App\Models\Customer\CustomerProspect;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Opportunity\Quotation\ItemableQuotationPart;
use App\Models\Opportunity\Survey\SurveyRequest;
use App\Models\Procurement\Procurement;

class ItemableBillOfQuantity extends Model
{
    use HasFactory;
    protected $guarded = [];

    function items() : HasMany{
        return $this->hasMany(Item::class, 'itemable_id');
    }

    function itemable(): MorphMany
    {
        return $this->morphMany(Item::class, 'itemable');
    }

    function itemableQuotationPart() : BelongsTo {
        return $this->belongsTo(ItemableQuotationPart::class, 'id', 'boq_id');
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

    function procurement() : HasMany {
        return $this->hasMany(Procurement::class, 'itemable_bill_of_quantity_id');
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

    function scopeDraft() {
        return $this->where('is_draft', 1)->doesnthave('priceRequests');
    }

    function scopePublish() {
        return $this->where('is_draft', 0)->where('is_final', 0)->whereNull('is_done')->has('priceRequests');
    }

    function scopeOnReview() {
        return $this->where('is_draft', 0)->where('is_final', 1)->whereNull('is_done')->has('priceRequests');
    }

    function scopeDone() {
        return $this->where('is_done', 1)->where(function($query) {
            $query->where('approval_manager_sales', 1)
                  ->orWhere('approval_manager_operation', 1)
                  ->orWhere('approval_director', 1)
                  ->orWhere('approval_finman', 1);
        });
    }

    function scopeCancel() {
        return $this->where('is_done', 0)->orWhere(function($query) {
            $query->where('approval_manager_sales', 0)
                  ->orWhere('approval_manager_operation', 0)
                  ->orWhere('approval_director', 0)
                  ->orWhere('approval_finman', 0);
        });
    }
}
