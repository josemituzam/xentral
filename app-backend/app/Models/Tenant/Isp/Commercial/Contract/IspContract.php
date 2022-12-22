<?php

namespace App\Models\Tenant\Isp\Commercial\Contract;

use App\Models\Tenant\Isp\Commercial\Contract\Traits\IspContractRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Tenant\Isp\Commercial\Contract\IspContractPlan;
use App\Models\Tenant\Isp\Commercial\Contract\IspContactContract;
use App\Models\Tenant\Isp\Commercial\Contract\IspCustomerContractTemplate;
use App\Models\Tenant\Isp\Commercial\Customer\IspCustomer;
use App\Models\Tenant\Isp\Commercial\Sector\IspSector;
use App\Models\Tenant\Traits\Status\Status;
use App\Models\Tenant\Traits\Template\TemplateContract;
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
        'sequential',
        'emission_at',
        'contract_plan_id',
        'break_day',
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

    public function getContractPlan()
    {
        return $this->belongsTo(IspContractPlan::class, 'contract_plan_id');
    }

    public function getSector()
    {
        return $this->belongsTo(IspSector::class, 'sector_id');
    }

    public function getCustomer()
    {
        return $this->belongsTo(IspCustomer::class, 'customer_id');
    }

    public function getStatus()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function getContactContract()
    {
        return $this->hasMany(IspContactContract::class, 'contract_id');
    }

    public function getTemplateContract()
    {
        return $this->belongsTo(TemplateContract::class, 'contract_version_id');
    }


    public function getCustomerContractTemplate()
    {
        return $this->hasOne(IspCustomerContractTemplate::class, 'contract_id');
    }
}
