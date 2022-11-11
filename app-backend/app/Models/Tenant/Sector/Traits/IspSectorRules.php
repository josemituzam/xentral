<?php

namespace App\Models\Tenant\Sector\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

trait IspSectorRules
{
    public static function createdRules($sector)
    {
        $messages = [
            'name.required' => 'El :attribute es requerido.',
            'name.max' => 'El :attribute no debe ser mayor a :max',
            'description.max' => 'El :attribute no debe ser mayor a :max',
        ];

        return Validator::make(
            $sector,
            [
                'name' =>
                [
                    'required',
                    'max:99',
                ],
                'description' => 'max:300',
            ],
            $messages
        );
    }


    public static function updatedRules($sector)
    {
        $messages = [
            'name.required' => 'El :attribute es requerido.',
            'name.max' => 'El :attribute no debe ser mayor a :max',
            'description.max' => 'El :attribute no debe ser mayor a :max',
        ];

        return Validator::make(
            $sector,
            [
                'name' => [
                    'required',
                    'max:99',
                ],
                'description' => 'max:250',
            ],
            $messages
        );
    }
}
