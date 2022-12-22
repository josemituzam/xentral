<?php

namespace App\Models\Tenant\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;

class ApiR2 extends Model
{
    use
        HasFactory,
        Uuids;

    protected $fillable = [
        'bucket_name',
        'account_id',
        'access_key_id',
        'access_key_secret',
        'short_code',
        'long_code',
    ];
}
