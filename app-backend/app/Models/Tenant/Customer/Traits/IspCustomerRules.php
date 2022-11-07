<?php

namespace App\Models\Tenant\Customer\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

trait IspCustomerRules
{
    public static function createdRules($service)
    {
        $messages = [
            'identification.required' => 'El :attribute es requerido.',
            'identification.unique' => 'El :attribute ya se encuentra registrado.',
            'identification.max' => 'El :attribute no debe ser mayor a :max',
            'started_at.required' => 'El :attribute es requerido.',
            'address.max' => 'El :attribute no debe ser mayor a :max',
            'email.max' => 'El :attribute no debe ser mayor a :max',
            'phone.max' => 'El :attribute no debe ser mayor a :max',
            'type_people.required' => 'El :attribute es requerido.',
            'type_identification.required' => 'El :attribute es requerido.',
        ];

        return Validator::make(
            $service,
            [
                'identification' =>
                [
                    'required',
                    'max:100',
                    Rule::unique('isp_customers', 'identification')->whereNull('deleted_at'),
                ],
                'started_at' => 'required',
                'address' => 'max:100',
                'email' => 'max:100|email:dns|email|unique:isp_customers,email',
                'phone' => 'max:100|unique:isp_customers,phone',

                'type_people' => 'required',
                'type_identification' => 'required',
            ],
            $messages
        );
    }


    public static function updatedRules($service)
    {
        $messages = [
            'name.required' => 'El :attribute es requerido.',
            'name.unique' => 'El :attribute ya se encuentra registrado.',
            'name.max' => 'El :attribute no debe ser mayor a :max',
            'description.max' => 'El :attribute no debe ser mayor a :max',
        ];

        return Validator::make(
            $service,
            [
                'name' => [
                    'required',
                    'max:99',
                    Rule::unique('isp_customers', 'name')->whereNull('deleted_at')->whereNot('id', $service["id"]),
                ],
                'description' => 'max:250',
            ],
            $messages
        );
    }
}
