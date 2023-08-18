<?php

namespace App\Models\Opportunity\Survey;

use App\Models\Customer\Customer;
use App\Models\Customer\CustomerContact;
use App\Models\ProjectManagement\WorkOrder;
use App\Traits\HasAdditionalSurveyForm;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SiteSurveyGSMBooster extends Model
{
    use HasFactory, HasAdditionalSurveyForm;

    protected $guarded = [];
    protected $table = 'site_survey_gsm_boosters';

    function surveyRequest() : BelongsTo {
        return $this->belongsTo(SurveyRequest::class);
    }

    function workOrder() : BelongsTo {
        return $this->belongsTo(WorkOrder::class);
    }

    function customer() : BelongsTo {
        return $this->belongsTo(Customer::class);
    }

    function customerContact() : BelongsTo {
        return $this->belongsTo(CustomerContact::class);
    }
}
