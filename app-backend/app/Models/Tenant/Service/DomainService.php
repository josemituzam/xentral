<?php

namespace App\Models\Tenant\Service;

use App\Models\Landlord\RequestDomain\Traits\RequestDomainRules;
use App\Models\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class DomainService extends Model
{
    use HasFactory,
        Notifiable,
        Uuids,
        RequestDomainRules,
        SoftDeletes,
        LogsActivity,
        CausesActivity;
    // use BelongsToTenant;
    // protected $guard_name = 'api';
    protected $fillable = [
        'tenant_id',
        'service_id',
        'price_monthly',
        'price_yearly',
        'max_contracts',
        'type',
        'short_code',
        'long_code',
        'order',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
