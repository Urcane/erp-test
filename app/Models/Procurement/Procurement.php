<?php

namespace App\Models\Procurement;

use App\Models\Opportunity\BoQ\ItemableBillOfQuantity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Procurement extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'procurements';

    public function procurementItems() : HasMany {
        return $this->hasMany(ProcurementItem::class);
    }

    public function itemableQuitation() : BelongsTo {
        return $this->belongsTo(ProcurementItem::class);
    }

    public function boq() : BelongsTo {
        return $this->belongsTo(ItemableBillOfQuantity::class, "itemable_bill_of_quantity_id");
    }

    public function requesterUser() : BelongsTo {
        return $this->belongsTo(User::class, "requester");
    }

    public function picUser() : BelongsTo {
        return $this->belongsTo(User::class, "pic");
    }
}
