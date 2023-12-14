<?php

namespace App\Traits;

use App\Models\Master\Payment;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasPayment
{
    function payments() : MorphMany {
        return $this->morphMany(Payment::class, 'paymentable');
    }

    function payment() : MorphOne {
        return $this->morphOne(Payment::class, 'paymentable');
    }
}
