<?php

namespace App\Models\Master;

use App\Traits\HasFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Payment extends Model
{
    use HasFactory, HasFile;

    protected $guarded = [];

    function paymentable() : MorphTo {
        return $this->morphTo();
    }
}
