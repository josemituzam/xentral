<?php

namespace App\Models\Landlord\RequestDomain\Traits;

use Illuminate\Support\Facades\Validator;

trait RequestDomainRules
{
    public static function createdRules($requestDomain)
    {
        $messages = [
            'fullname.required' => 'El :attribute es requerido.',
            'fullname.max' => 'El :attribute no debe ser mayor a :max',
            'email.required' => 'El :attribute es requerido.',
            'email.email' => 'El :attribute no es válido.',
            'email.unique' => 'El :attribute ya se encuentra registrado.',
            'email.max' => 'El :attribute no debe ser mayor a :max',
            'domain_name.required' => 'El :attribute es requerido.',
            'domain_name.unique' => 'El :attribute ya se encuentra registrado.',
            'domain_name.max' => 'El :attribute no debe ser mayor a :max',
            'company_name.required' => 'El :attribute es requerido.',
            'company_name.unique' => 'El :attribute ya se encuentra registrado.',
            'company_name.max' => 'El :attribute no debe ser mayor a :max',
            'password.required' => 'El :attribute es requerido'
        ];

        return Validator::make(
            $requestDomain,
            [
                'fullname' => 'max:200|required:request_domains,fullname',
                'email' => 'max:200|email:dns|required|email|unique:request_domains,email',
                'domain_name' => 'max:200|required|unique:request_domains,domain_name',
                'company_name' => 'max:200|required|unique:request_domains,company_name',
                'password' => 'required'
            ],
            $messages
        );
    }

    public static function updatedRules($requestDomain)
    {
        $messages = [
            'fullname.required' => 'El :attribute es requerido.',
            'fullname.max' => 'El :attribute no debe ser mayor a :max',
            'email.required' => 'El :attribute es requerido.',
            'email.email' => 'El :attribute no es válido.',
            'email.unique' => 'El :attribute ya se encuentra registrado.',
            'email.max' => 'El :attribute no debe ser mayor a :max',
            'domain_name.required' => 'El :attribute es requerido.',
            'domain_name.unique' => 'El :attribute ya se encuentra registrado.',
            'domain_name.max' => 'El :attribute no debe ser mayor a :max',
            'company_name.required' => 'El :attribute es requerido.',
            'company_name.unique' => 'El :attribute ya se encuentra registrado.',
            'company_name.max' => 'El :attribute no debe ser mayor a :max'
        ];

        return Validator::make(
            $requestDomain,
            [
                'fullname' => 'max:200|required:request_domains,fullname. ' . $requestDomain["id"],
                'email' => 'required|dns|email:dns|unique:request_domains,email,' . $requestDomain["id"],
                'domain_name' => 'required|unique:request_domains,domain_name,' . $requestDomain["id"],
                'company_name' => 'max:200|required|unique:request_domains,company_name' . $requestDomain["id"],
            ],
            $messages
        );
    }
}
