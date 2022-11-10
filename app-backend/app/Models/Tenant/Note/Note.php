<?php

namespace App\Models\Tenant\Note;

use App\Models\Tenant\Note\Traits\NoteRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class Note extends Model
{
    use
        HasFactory,
        Notifiable,
        HasRoles,
        Uuids,
        SoftDeletes,
        LogsActivity,
        NoteRules,
        CausesActivity;

    protected $fillable = [
        'note',
        'module_short_code',
        'reference_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
