<?php

namespace App\Models\Core\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;

class ApiR2 extends Model
{
    use
        HasFactory,
        Uuids;

    protected $fillable = [
        'account_id',
        'access_key_id',
        'access_key_secret',
        'key_image_name',
        'key_file_name',
        'short_code',
        'long_code',
    ];
}
