<?php

namespace App\Models\Tenant\Traits\Sequential;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class Sequential extends Model
{
    use
        HasFactory,
        Notifiable,
        Uuids,
        SoftDeletes,
        LogsActivity,
        CausesActivity;

    protected $fillable = [
        'contracts',
        'tickets',
        'accounts_receivable',
        'advances',
        'returns',
        'sales_notes',
        'proformas',
        'bills'
    ];
}
