<?php

namespace App\Models\Tenant\Isp\Commercial\Plan\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

trait IspPlanRules
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
