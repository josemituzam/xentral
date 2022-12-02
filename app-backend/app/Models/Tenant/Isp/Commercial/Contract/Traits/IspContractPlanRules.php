<?php

namespace App\Models\Tenant\Isp\Commercial\Contract\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

trait IspContractPlanRules
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
