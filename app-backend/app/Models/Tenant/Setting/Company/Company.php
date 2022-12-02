<?php

namespace App\Models\Tenant\Setting\Company;


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
        Notifiable,
        Uuids,
        SoftDeletes,
        LogsActivity,
        CausesActivity;

    protected $fillable = [
        'name',
        'country',
        'short_code',
        'long_code',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
