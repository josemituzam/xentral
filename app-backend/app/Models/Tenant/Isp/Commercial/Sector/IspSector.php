<?php

namespace App\Models\Tenant\Isp\Commercial\Sector;

use App\Models\Tenant\Isp\Commercial\Sector\Traits\IspSectorRules;
use App\Models\Tenant\Isp\Commercial\Sector\IspLocation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class IspSector extends Model
{
    use
        HasFactory,
        IspSectorRules,
        Notifiable,
        Uuids,
        LogsActivity,
        SoftDeletes,
        CausesActivity;

    protected $fillable = [
        'sector',
        'location_id',
        'latitude',
        'longitude',
        'short_code',
        'long_code',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function getLocation()
    {
        return $this->belongsTo(IspLocation::class, 'location_id');
    }
}
