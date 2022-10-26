<?php

namespace App\Models\Landlord\Service;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class ServiceDetail extends Model
{
    use
        HasFactory,
        Notifiable,
        Uuids,
        LogsActivity,
        CausesActivity;

    protected $fillable = [
        'service_id',
        'min_users',
        'max_users',
        'price_monthly',
        'created_by',
    ];
}
