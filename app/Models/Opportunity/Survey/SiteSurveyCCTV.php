<?php

namespace App\Models\Opportunity\Survey;

use App\Models\Customer\Customer;
use App\Models\Customer\CustomerContact;
use App\Models\Master\File;
use App\Models\Opportunity\Survey\Master\SiteSurveyServiceType;
use App\Models\ProjectManagement\WorkOrder;
use App\Traits\HasAdditionalSurveyForm;
use App\Traits\HasFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class SiteSurveyCCTV extends Model
{
    use HasFactory, HasAdditionalSurveyForm, HasFile;

    protected $guarded = [];
    protected $table = 'site_survey_cctvs';

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

    function siteSurveyServiceType() : BelongsTo {
        return $this->belongsTo(SiteSurveyServiceType::class);
    }

    function customerSignFile() : MorphOne {
        return $this->morphOne(File::class, 'fileable')->where('additional', 'site-survey/customer_sign');   
    }
}
