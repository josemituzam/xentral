<?php

namespace App\Models\Tenant\Isp\Commercial\Contract;

use App\Models\Tenant\Isp\Commercial\Contract\Traits\IspContractRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Tenant\Isp\Commercial\Contract\IspContractPlan;
use App\Models\Tenant\Isp\Commercial\Customer\IspCustomer;
use App\Models\Tenant\Isp\Commercial\Sector\IspSector;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class IspContract extends Model
{
    use
        HasFactory,
        IspContractRules,
        Notifiable,
        Uuids,
        SoftDeletes,
        LogsActivity,
        CausesActivity;

    protected $fillable = [
        'emission_at',
        'contract_plan_id',
        'break_at',
        'customer_id',
        'username',
        'sector_id',
        'address_contract',
        'contract_version_id',
        'payment_id',
        'adviser_id',
        'status_id',


        'is_reconnection_cost',
        'reconnection_cost',
        'is_from_another_provider',
        'another_provider_id',
        'is_pay_to_invoice',
        'is_apply_arcotel',
        'is_not_cut_for_debt',
        'is_not_generate_invoice_service',


        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function ispcontractplan()
    {
        return $this->belongsTo(IspContractPlan::class, 'contract_plan_id');
    }

    public function ispsector()
    {
        return $this->belongsTo(IspSector::class, 'sector_id');
    }

    public function ispcustomer()
    {
        return $this->belongsTo(IspCustomer::class, 'customer_id');
    }
}
