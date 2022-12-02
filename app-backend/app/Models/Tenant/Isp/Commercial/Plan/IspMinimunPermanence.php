<?php

namespace App\Models\Tenant\Isp\Commercial\Plan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;


class IspMinimunPermanence extends Model
{
    use
        HasFactory,
        Notifiable,
        Uuids,
        SoftDeletes,
        LogsActivity,
        CausesActivity;

    protected $fillable = [
        'name',
        'description',
        'short_code',
        'long_code',
        'orderBy',
        'is_active',
        'created_by',
        'updated_by'
    ];

    
}


