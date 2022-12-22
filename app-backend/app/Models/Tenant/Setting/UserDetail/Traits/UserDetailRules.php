<?php

namespace App\Models\Tenant\Setting\UserDetail\Traits;

use Illuminate\Support\Facades\Validator;


trait UserDetailRules
{
    public static function createdRules($service)
    {
        $messages = [];

        return Validator::make(
            $service,
            [],
            $messages
        );
    }


    public static function updatedRules($service)
    {
        $messages = [];

        return Validator::make(
            $service,
            [],
            $messages
        );
    }
}
