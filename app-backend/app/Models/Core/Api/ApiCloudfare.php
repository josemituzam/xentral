<?php

namespace App\Models\Core\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;

class ApiCloudfare extends Model
{
    use
        HasFactory,
        Uuids;

    protected $fillable = [
        'token',
        'type',
        'type_id',
        'ip',
        'domain',
        'short_code',
        'long_code',
    ];
}
