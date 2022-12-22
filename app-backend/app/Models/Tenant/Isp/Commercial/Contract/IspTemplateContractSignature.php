<?php

namespace App\Models\Tenant\Isp\Commercial\Contract;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;


class IspTemplateContractSignature extends Model
{
    use
        HasFactory,
        Uuids,
        LogsActivity,
        CausesActivity;

    protected $fillable = [
        'customer_contract_template_id',
        'name',
        'description',
        'is_active',
        'is_required',
        'signature',
        'long_code',
        'orderby',
        'short_code',
        'created_by',
        'updated_by',
    ];
}
