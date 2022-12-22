<?php

namespace App\Models\Tenant\Isp\Commercial\Customer\Traits;

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

            'firstname.max' => 'El :attribute no debe ser mayor a :max',
            'lastname.max' => 'El :attribute no debe ser mayor a :max',
            'name_company.max' => 'El :attribute no debe ser mayor a :max',

            'started_at.required' => 'El :attribute es requerido.',

            'address.max' => 'El :attribute no debe ser mayor a :max',
            'address.required' => 'El :attribute es requerido.',

            'email.max' => 'El :attribute no debe ser mayor a :max',
            'email.required' => 'El :attribute es requerido.',

            'phone.max' => 'El :attribute no debe ser mayor a :max',
            'phone.required' => 'El :attribute es requerido.',

            'type_people.required' => 'El :attribute es requerido.',

            'type_identification.required' => 'El :attribute es requerido.',

            'firstname_representative.max' => 'El :attribute no debe ser mayor a :max',
            'lastname_representative.max' => 'El :attribute no debe ser mayor a :max',
            'phone_representative.max' => 'El :attribute no debe ser mayor a :max',
        ];

        return Validator::make(
            $service,
            [
                'firstname' => 'max:100',
                'lastname' => 'max:100',
                'name_company' => 'max:100',

                'identification' =>
                [
                    'required',
                    'max:100',
                    Rule::unique('isp_customers', 'identification')->whereNull('deleted_at'),
                ],

                'started_at' => 'required|date_format:Y-m-d',

                'address' => 'max:100|required',

                'email' => 'max:100|required|email:dns|email',

                'phone' => 'max:100|required',

                'type_people' => 'required',
                'type_identification' => 'required',

                'firstname_representative' => 'max:100',
                'lastname_representative' => 'max:100',
                'phone_representative' => 'max:100',
            ],
            $messages
        );
    }


    public static function updatedRules($service)
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
                    Rule::unique('isp_customers', 'identification')->whereNull('deleted_at')->whereNot('id', $service["id"]),
                ],
                'started_at' => 'required',
                'address' => 'max:100',
                'email' => 'max:100|email:dns|email',
                'phone' => 'max:100|unique:isp_customers,phone',
                'type_people' => 'required',
                'type_identification' => 'required',
            ],
            $messages
        );
    }
}
