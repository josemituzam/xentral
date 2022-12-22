<?php

namespace App\Models\Tenant\Setting\Company\Traits;

use Illuminate\Support\Facades\Validator;


trait SaleRules
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
