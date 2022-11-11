<?php

namespace App\Models\Tenant\Province;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tenant\City\IspCity;

class IspProvince extends Model
{
    use HasFactory;



    public function cities()
    {
        return $this->hasMany(IspCity::class);
    }
}
