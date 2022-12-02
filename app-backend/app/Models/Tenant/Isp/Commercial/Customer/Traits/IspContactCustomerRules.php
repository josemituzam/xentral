<?php

namespace App\Models\Tenant\Isp\Commercial\Customer\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

trait IspContactCustomerRules
{
    public static function createdRules($service)
    {
        $messages = [
            'name.max' => 'El :attribute no debe ser mayor a :max',
            'name_parent.max' => 'El :attribute no debe ser mayor a :max',

            'email.required' => 'El :attribute es requerido.',
            'email.email' => 'El :attribute no es válido.',
            'email.unique' => 'El :attribute ya se encuentra registrado.',
            'email.max' => 'El :attribute no debe ser mayor a :max',
        ];

        return Validator::make(
            $service,
            [
                'name' => 'max:100',
                'name_parent' => 'max:100',
                'email' => 'max:100|email:dns|email',
            ],
            $messages
        );
    }
}
