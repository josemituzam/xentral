<?php

namespace App\Models\Tenant\Isp\Commercial\Sector;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class IspLocation extends Model
{
    use
        HasFactory,
        Notifiable,
        Uuids,
        LogsActivity,
        CausesActivity;

    protected $fillable = [
        'location',
        'city',
        'state',
        'long_code',
        'short_code',
        'is_active',
        'created_by',
        'updated_by'
    ];
}
