<?php

namespace App\Models\Tenant\Isp\Commercial\Contract;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class IspCustomerContractTemplate extends Model
{
    use
        HasFactory,
        Uuids,
        LogsActivity,
        CausesActivity;

    protected $fillable = [
        'contract_id',
        'html',
        'path',
        'is_signed',
        'is_generated',
        'created_by',
        'updated_by',
    ];
}
