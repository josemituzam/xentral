<?php

namespace App\Models\Tenant\File;

use App\Models\Tenant\Traits\Status\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;

class File extends Model
{
    use
        HasFactory,
        Uuids;

    protected $fillable = [
        'name',
        'contextable_id',
        'filename',
        'path',
        'extention',
        'type',
        'short_code',
        'long_code',
        'status_id'
    ];

    public function getStatus()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
