<?php

namespace App\Models\Tenant\Isp\Commercial\Contract;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class IspContractPlan extends Model
{
    use
        HasFactory,
        Notifiable,
        Uuids,
        LogsActivity,
        CausesActivity;

    protected $fillable = [
        'plan_id',
        'installation_cost',
        'month_cost',
        'installation_promotion',
        'minimun_permanence_id',
        'permanence_cost',
        'is_permanence_cost',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
