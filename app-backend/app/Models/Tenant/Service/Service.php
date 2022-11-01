<?php

namespace App\Models\Tenant\Service;

use App\Models\Landlord\Service\Traits\ServiceRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class Service extends Model
{
    use
        HasFactory,
        Notifiable,
        HasRoles,
        Uuids,
        ServiceRules,
        SoftDeletes,
        LogsActivity,
        CausesActivity;

    protected $fillable = [
        'name',
        'description',
        'short_code',
        'long_code',
        'order',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

}

