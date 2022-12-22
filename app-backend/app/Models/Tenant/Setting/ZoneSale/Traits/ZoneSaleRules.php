<?php

namespace App\Models\Tenant\Setting\ZoneSale\Traits;

use Illuminate\Support\Facades\Validator;


trait ZoneSaleRules
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
