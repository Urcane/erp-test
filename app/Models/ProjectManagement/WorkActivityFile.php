<?php

namespace App\Models\ProjectManagement;

use App\Traits\HasFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkActivityFile extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function workActivity()
    {
        return $this->belongsTo(WorkActivity::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
