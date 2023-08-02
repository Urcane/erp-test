<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaxStatus extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function userTax(): HasMany
    {
        return $this->hasMany(UserTax::class);
    }
}
