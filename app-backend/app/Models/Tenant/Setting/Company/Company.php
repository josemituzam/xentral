<?php

namespace App\Models\Tenant\Setting\Company;

use App\Models\Tenant\Setting\Company\Traits\CompanyRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class Company extends Model
{
    use
        HasFactory,
        CompanyRules,
        Notifiable,
        Uuids,
        SoftDeletes,
        LogsActivity,
        CausesActivity;

    protected $fillable = [
        'name_company',
        'name_commercial',
        'type_identification',
        'identification',
        'country',
        'is_accounting',
        'is_special',
        'address',
        'phone_principal',
        'phone_secondary',
        'break_day',
        'decimal',
        'google_key',
        'electronic_signature',
        'short_code',
        'long_code',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
