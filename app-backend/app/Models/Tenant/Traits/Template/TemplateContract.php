<?php

namespace App\Models\Tenant\Traits\Template;

use App\Models\Tenant\Traits\Template\Traits\TemplateContractRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class TemplateContract extends Model
{
    use
        TemplateContractRules,
        HasFactory,
        Notifiable,
        Uuids,
        SoftDeletes,
        LogsActivity,
        CausesActivity;

    protected $fillable = [
        'name',
        'path',
        'template_code',
        'orientation',
        'html',
        'margin_bottom',
        'margin_left',
        'margin_top',
        'margin_right',
        'size',
        'orderBy',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
