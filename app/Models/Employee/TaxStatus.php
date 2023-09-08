<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function userTaxs(): HasMany
    {
        return $this->hasMany(UserTax::class);
    }
}
