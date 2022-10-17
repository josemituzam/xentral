<?php

namespace App\Models\Landlord\RequestDomain;

use App\Models\Landlord\RequestDomain\Traits\RequestDomainRules;
use App\Models\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class RequestDomain extends Model
{
    use  HasFactory, Notifiable, HasRoles, Uuids, RequestDomainRules, SoftDeletes;
    // use BelongsToTenant;
    // protected $guard_name = 'api';
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'type',
        'tenant_id',
        'domain_name',
        'company_name',
        'disapprove_reason',
    ];
}
