<?php

namespace App\Models\Tenant\Isp\Commercial\Plan;

use App\Models\Tenant\Isp\Commercial\Plan\Traits\IspPlanRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use App\Models\Tenant\Isp\Commercial\Plan\IspMinimunPermanence;

class IspPlanDetail extends Model
{
    use
        HasFactory,
        IspPlanRules,
        Notifiable,
        Uuids,
        LogsActivity,
        CausesActivity;

    protected $fillable = [
        'plan_id',
        'installation_cost',
        'month_cost',
        'penalty_amount',
        'meters_free',
        'additional_meter_cost',
        'minimun_permanence_id'
    ];

    public function getMinimunPermanence()
    {
        return $this->belongsTo(IspMinimunPermanence::class, 'minimun_permanence_id');
    }
}
