<?php

namespace App\Models\Tenant\Service\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

trait ServiceRules
{
    public static function createdRules($service)
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
                'name' =>
                [
                    'required',
                    'max:99',
                    Rule::unique('services', 'name')->whereNull('deleted_at'),
                ],
                'description' => 'max:300',
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
                    Rule::unique('services', 'name')->whereNull('deleted_at')->whereNot('id', $service["id"]),
                ],
                'description' => 'max:250',
            ],
            $messages
        );
    }
}
