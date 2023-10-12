<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Permission;
use Yajra\DataTables\Html\Editor\Fields\BelongsTo;

class Feature extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function permissions() : BelongsToMany {
        return $this->belongsToMany(Permission::class, "feature_has_permissions");
    }
}
