<?php

namespace App\Models\Landlord\RequestDomain;

use App\Models\Landlord\RequestDomain\Traits\RequestDomainRules;
use App\Models\Traits\Uuids;
use App\Models\Landlord\Service\Service;
use App\Models\Landlord\RequestDomain\DomainService;
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

    protected $fillable = [
        'fullname',
        'email',
        'password',
        'type',
        'tenant_id',
        'domain_name',
        'url',
        'country',
        'company_name',
        'is_active',
        'is_approved'
    ];

    protected $hidden = ['updated_at', 'created_at', 'deleted_at', 'password', 'type'];

    public function service()
    {
        return $this->belongsToMany(Service::class, 'domain_services');
    }

    public function domainService()
    {
        return $this->hasMany(DomainService::class);
    }
}
