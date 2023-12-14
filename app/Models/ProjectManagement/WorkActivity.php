<?php

namespace App\Models\ProjectManagement;

use App\Models\Master\File;
use App\Models\User;
use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkActivity extends Model
{
    use HasFactory, HasUser;
    protected $guarded = [];

    public function workList()
    {
        return $this->belongsTo(WorkList::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workActivityFiles()
    {
        return $this->hasMany(WorkActivityFile::class);
    }

    public function attachments()
    {
        return $this->belongsToMany(File::class, 'work_activity_files', 'work_activity_id', 'file_id');
    }
}
