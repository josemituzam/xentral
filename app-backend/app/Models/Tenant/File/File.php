<?php

namespace App\Models\Tenant\File;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;

class File extends Model
{
    use
        HasFactory,
        Uuids;

    protected $fillable = [
        'contextable_id',
        'filename',
        'path',
        'extention',
        'type',
        'short_code',
        'long_code',
    ];
}
