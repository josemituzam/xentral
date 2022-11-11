<?php

namespace App\Models\Tenant\Parish;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tenant\Sector\IspSector;
use App\Models\Tenant\City\IspCity;

class IspParish extends Model
{
    use HasFactory;

    public function Sectors()
    {
        return $this->hasMany(IspSector::class);
    }

    public function City () {
        return $this->belongsTo(IspCity::class);
    }
}
