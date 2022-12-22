<?php

namespace App\Models\Tenant\Isp\Commercial\Plan;

use App\Models\Tenant\Isp\Commercial\Plan\Traits\IspPlanRules;
use App\Models\Tenant\Isp\Commercial\Plan\IspLastMiles;
use App\Models\Tenant\Isp\Commercial\Plan\IspPlanDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class IspPlan extends Model
{
    use
        HasFactory,
        IspPlanRules,
        Notifiable,
        Uuids,
        SoftDeletes,
        LogsActivity,
        CausesActivity;

    protected $fillable = [
        'name',
        'description',
        'last_mile_id',
        'increase',
        'type_increase',
        'downfall',
        'type_downfall',
        'compartition',
        'short_code',
        'long_code',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function getLastMile()
    {
        return $this->belongsTo(IspLastMiles::class, 'last_mile_id');
    }

    public function getPlanDetail()
    {
        return $this->hasMany(IspPlanDetail::class, 'plan_id');
    }
}
