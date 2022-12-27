<?php

namespace App\Models\Tenant\Setting\UserDetail;

use App\Models\Tenant\Setting\Company\Sale;
use App\Models\Tenant\Setting\UserDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSale extends Model
{
    use  HasFactory, Uuids, SoftDeletes;
    protected $fillable = [
        'user_id',
        'sale_id',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function getSale()
    {
        return $this->belongsTo(Sale::class, 'sale_id');
    }
}
