<?php

namespace App\Models\Landlord\RequestDomain\Traits;

use Illuminate\Support\Facades\Validator;

trait RequestDomainRules
{
    public static function createdRules($requestDomain)
    {
        $messages = [
            'firstname.required' => 'El :attribute es requerido.',
            'lastname.required' => 'El :attribute es requerido.',
            'firstname.max' => 'El :attribute no debe ser mayor a :max',
            'lastname.max' => 'El :attribute no debe ser mayor a :max',
            'email.required' => 'El :attribute es requerido.',
            'email.email' => 'El :attribute no es válido.',
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
                'firstname' => 'max:200|required:request_domains,firstname',
                'lastname' => 'max:200|required:request_domains,lastname',
                'email' => 'max:200|required|email|unique:request_domains,email',
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
            'name.required' => 'El :attribute es requerido.',
            'email.required' => 'El :attribute es requerido.',
            'email.email' => 'El correo eletrónico no es válido.',
            'email.min' => 'El correo eletrónico no tiene la longitud correcta.',
            'domain_name.required' => 'El :attribute es requerido.',
            'domain_name.unique' => 'El :attribute ya se encuentra registrado.',
        ];

        return Validator::make(
            $requestDomain,
            [
                'name' => 'required:request_domains,name,' . $requestDomain["id"],
                'email' => 'required|email|unique:request_domains,email,' . $requestDomain["id"],
                'domain_name' => 'required|unique:request_domains,domain_name,' . $requestDomain["id"],
            ],
            $messages
        );
    }
}
