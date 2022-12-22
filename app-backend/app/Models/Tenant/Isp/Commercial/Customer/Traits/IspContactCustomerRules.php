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
            'name.required' => 'El :attribute es requerido.',

            'name_parent.max' => 'El :attribute no debe ser mayor a :max',
            'name_parent.required' => 'El :attribute es requerido.',

            'email.required' => 'El :attribute es requerido.',
            'email.email' => 'El :attribute no es válido.',
            'email.max' => 'El :attribute no debe ser mayor a :max',
        ];

        return Validator::make(
            $service,
            [
                'name' => 'max:100|required',
                'name_parent' => 'max:100|required',
                'email' => 'max:100|email:dns|email',
            ],
            $messages
        );
    }
}
