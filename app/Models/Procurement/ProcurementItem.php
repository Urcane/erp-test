<?php

namespace App\Models\Procurement;

use App\Models\Inventory\InventoryGood;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProcurementItem extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function procurementItemStatus() : HasMany {
        return $this->hasMany(ProcurementItemStatus::class)->orderByDesc("id");
    }

    public function procurement() : BelongsTo {
        return $this->belongsTo(Procurement::class);
    }

    public function item() : BelongsTo {
        return $this->belongsTo(Procurement::class);
    }

    public function inventoryGood() : BelongsTo {
        return $this->belongsTo(InventoryGood::class);
    }
}
