<?php

namespace App\Models\Tenant\Sector;

use App\Models\Tenant\Sector\Traits\IspSectorRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use App\Models\Tenant\Parish\IspParish;

class IspSector extends Model
{
    use HasFactory,
        Notifiable,
        Uuids,
        SoftDeletes,
        LogsActivity,
        IspSectorRules,
        CausesActivity;

        protected $fillable = [
            'name',
            'isp_parish_id',
            'description',
            'latitude',
            'longitude',
            'is_active',
            'created_by',
            'updated_by',
            'deleted_by',
            'short_code',
            'long_code',
            'deleted_at',
            'created_at',
            'updated_at'
        ];

    /*public function Parish()
    {
        return $this->belongsTo(IspParish::class);
    }*/
}
