<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WareHouseGood extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function wareHouse()
    {
        return $this->belongsTo(WareHouse::class);
    }

    public function inventoryGood()
    {
        return $this->belongsTo(InventoryGood::class);
    }

    public function inventoryUnitMaster()
    {
        return $this->belongsTo(InventoryUnitMaster::class);
    }
}
