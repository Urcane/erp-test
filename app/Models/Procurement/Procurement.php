<?php

namespace App\Models\Procurement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Procurement extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function procurementItems() : HasMany {
        return $this->hasMany(ProcurementItem::class);
    }

    public function itemableQuitation() : BelongsTo {
        return $this->belongsTo(ProcurementItem::class);
    }
}
