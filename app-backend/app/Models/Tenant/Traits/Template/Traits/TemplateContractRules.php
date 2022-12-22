<?php

namespace App\Models\Tenant\Traits\Template\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

trait TemplateContractRules
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
