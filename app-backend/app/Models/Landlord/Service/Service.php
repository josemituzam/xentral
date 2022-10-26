<?php

namespace App\Models\Landlord\Service;

use App\Models\Landlord\Service\Traits\ServiceRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use App\Models\Landlord\Service\ServiceDetail;

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

    public function serviceDetail()
    {
        return $this->hasMany(ServiceDetail::class);
    }
}
