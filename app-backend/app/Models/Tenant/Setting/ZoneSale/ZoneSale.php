<?php

namespace App\Models\Tenant\Setting\ZoneSale;

use App\Models\Tenant\Setting\ZoneSale\Traits\ZoneSaleRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class ZoneSale extends Model
{
    use
    HasFactory,
    Notifiable,
    Uuids,
    SoftDeletes,
    LogsActivity,
    ZoneSaleRules,
    CausesActivity;

    protected $fillable = [
        'name',
        'code',
        'short_code',
        'long_code',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
