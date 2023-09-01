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

use App\Http\Requests\Opportunity\Survey\SurveyRequest;
use App\Models\Opportunity\Quotation\ItemableQuotationPart;

class ItemableBillOfQuantity extends Model
{
    use HasFactory;
    protected $guarded = [];

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
