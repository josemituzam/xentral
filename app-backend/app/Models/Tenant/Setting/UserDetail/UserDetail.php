<?php

namespace App\Models\Tenant\Setting\UserDetail;

use App\Models\Core\Auth\Tenant\User;
use App\Models\Tenant\Setting\UserDetail\Traits\UserDetailRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDetail extends Model
{
    use  HasFactory, Uuids, SoftDeletes, UserDetailRules;
    protected $fillable = [
        'firstname',
        'lastname',
        'fullname',
        'user_id',
        'type_identification',
        'identification',
        'birthday_at',
        'phone',
        'address',
        'cant_extra_time',
        'day_extra_time',
        'zone_sale_id',
        'description',
        'is_active',
        'is_default',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
