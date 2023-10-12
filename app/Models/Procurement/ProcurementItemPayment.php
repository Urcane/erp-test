<?php

namespace App\Models\Procurement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProcurementItemPayment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function procurementItem() : BelongsTo {
        return $this->belongsTo(ProcurementItem::class);
    }
}
