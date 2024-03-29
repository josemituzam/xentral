<?php

namespace App\Models\Landlord\RequestDomain;

use App\Models\Landlord\RequestDomain\Traits\RequestDomainRules;
use App\Models\Traits\Uuids;
use App\Models\Landlord\Service\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class RequestDomain extends Model
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
        'fullname',
        'email',
        'password',
        'type',
        'tenant_id',
        'domain_name',
        'company_name',
        'is_active',
        'is_approved'
    ];

    public function service()
    {
        return $this->belongsToMany(Service::class, 'domain_services');
    }
}
