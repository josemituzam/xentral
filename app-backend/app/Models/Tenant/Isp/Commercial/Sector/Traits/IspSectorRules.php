<?php

namespace App\Models\Tenant\Isp\Commercial\Sector\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

trait IspSectorRules
{
    public static function createdRules($obj)
    {
        $messages = [
            'location.required' => 'El :attribute es requerido.',
            //'location.unique' => 'El :attribute ya se encuentra registrado.',
            'location.max' => 'El :attribute no debe ser mayor a :max',
            'sector.max' => 'El :attribute no debe ser mayor a :max',
            'sector.required' => 'El :attribute es requerido.',
            // 'sector.unique' => 'El :attribute ya se encuentra registrado.',
            'city.max' => 'El :attribute no debe ser mayor a :max',
            'city.required' => 'El :attribute es requerido.',
            'state.max' => 'El :attribute no debe ser mayor a :max',
            'state.required' => 'El :attribute es requerido.',
            'latitude.max' => 'El :attribute no debe ser mayor a :max',
            'latitude.required' => 'El :attribute es requerido.',
            'longitude.max' => 'El :attribute no debe ser mayor a :max',
            'longitude.required' => 'El :attribute es requerido.',
        ];

        return Validator::make(
            $obj,
            [
                'location' =>
                [
                    'required',
                    'max:300',
                    //Rule::unique('isp_locations', 'location')->where('city', $obj["city"])->where('state', $obj["state"]),
                ],
                'sector' =>
                [
                    'required',
                    'max:250',
                    //Rule::unique('isp_sectors', 'sector')->whereNull('deleted_at'),
                ],
                'city' => 'required|max:100',
                'state' => 'required|max:100',
                'latitude' => 'required|max:200',
                'longitude' => 'required|max:200',
            ],
            $messages
        );
    }


    public static function updatedRules($obj)
    {
        $messages = [
            'location.required' => 'El :attribute es requerido.',
            'location.max' => 'El :attribute no debe ser mayor a :max',
            'sector.max' => 'El :attribute no debe ser mayor a :max',
            'sector.required' => 'El :attribute es requerido.',
            //'sector.unique' => 'El :attribute ya se encuentra registrado.',
            'city.max' => 'El :attribute no debe ser mayor a :max',
            'city.required' => 'El :attribute es requerido.',
            'state.max' => 'El :attribute no debe ser mayor a :max',
            'state.required' => 'El :attribute es requerido.',
            'latitude.max' => 'El :attribute no debe ser mayor a :max',
            'latitude.required' => 'El :attribute es requerido.',
            'longitude.max' => 'El :attribute no debe ser mayor a :max',
            'longitude.required' => 'El :attribute es requerido.',
        ];

        return Validator::make(
            $obj,
            [
                'location' => [
                    'required',
                    'max:99',
                    //Rule::unique('isp_locations', 'location')->whereNot('id', $obj["id"]),
                ],
                'sector' =>
                [
                    'required',
                    'max:250',
                    //Rule::unique('isp_sectors', 'sector')->whereNull('deleted_at'),
                ],
                'city' => 'required|max:100',
                'state' => 'required|max:100',
                'latitude' => 'required|max:200',
                'longitude' => 'required|max:200',
            ],
            $messages
        );
    }
}
