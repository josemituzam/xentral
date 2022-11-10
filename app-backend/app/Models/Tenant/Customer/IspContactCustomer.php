<?php

namespace App\Models\Tenant\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class IspContactCustomer extends Model
{
    use
        HasFactory,
        Uuids,
        LogsActivity,
        CausesActivity;

    protected $fillable = [
        'customer_id',
        'name',
        'name_parent',
        'email',
        'type_number',
        'phone',
        'created_by',
        'updated_by',
    ];
}
