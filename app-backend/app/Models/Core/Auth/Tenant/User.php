<?php

namespace App\Models\Core\Auth\Tenant;

use App\Models\Core\Traits\JwtTrait;
use App\Models\Traits\Uuids;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
//use Spatie\Activitylog\Traits\LogsActivity;
//use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory,
        Notifiable,
        Uuids,
        JwtTrait,
       // LogsActivity,
       // CausesActivity,
        SoftDeletes,
        HasRoles,
        HasPermissions;


    protected $guard = 'apiTenant';

    // protected $guard_name = "apitenant";
    public function guardName()
    {
        return 'apiTenant';
    }
    /** 
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'confirm_account_token',
        'confirm_account_token_time',
        'reset_password_token',
        'reset_password_token_time',
        'force_password_change',
        'last_login_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
