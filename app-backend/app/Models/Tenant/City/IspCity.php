<?php

namespace App\Models\Tenant\City;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tenant\Parish\IspParish;
use App\Models\Tenant\Provice\IspProvince;

class IspCity extends Model
{
    use HasFactory;

    public function Parishes()
    {
        return $this->hasMany(IspParish::class);
    }

    public function Province () {
        return $this->belongsTo(IspProvince::class);
    }
}
