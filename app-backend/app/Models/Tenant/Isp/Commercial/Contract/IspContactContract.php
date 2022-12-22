<?php

namespace App\Models\Tenant\Isp\Commercial\Contract;

use App\Models\Tenant\Isp\Commercial\Contract\Traits\IspContactContractRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class IspContactContract extends Model
{
    use
        HasFactory,
        IspContactContractRules,
        Uuids,
        LogsActivity,
        CausesActivity;

    protected $fillable = [
        'contract_id',
        'name',
        'name_parent',
        'email',
        'type_number',
        'phone',
        'created_by',
        'updated_by',
    ];
}
