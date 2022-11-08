<?php

namespace App\Models\Tenant\Customer;

use App\Models\Tenant\Customer\Traits\IspCustomerRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class IspCustomer extends Model
{
    use
        HasFactory,
        IspCustomerRules,
        Notifiable,
        Uuids,
        SoftDeletes,
        LogsActivity,
        CausesActivity;

    protected $fillable = [
        'type_people',
        'type_identification',
        'identification',
        'name_company',
        'firstname',
        'lastname',
        'fullname',
        'started_at',
        'type_gender',
        'address',
        'type_number',
        'phone',
        'email',
        'is_accounting',
        'is_disability',
        'is_old',
        'is_bond',
        'firstname_representative',
        'lastname_representative',
        'fullname_representative',
        'phone_representative',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
