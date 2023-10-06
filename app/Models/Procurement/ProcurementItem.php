<?php

namespace App\Models\Procurement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProcurementItem extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function procurementItemStatus() : HasMany {
        return $this->hasMany(ProcurementItemStatus::class);
    }

    public function procurementItemPayment() : HasMany {
        return $this->hasMany(ProcurementItemPayment::class);
    }

    public function procurement() : BelongsTo {
        return $this->belongsTo(Procurement::class);
    }
}
