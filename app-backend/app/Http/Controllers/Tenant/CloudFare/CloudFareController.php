<?php

namespace App\Http\Controllers\Tenant\RequestDomain;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CloudFareController extends Controller
{
    protected $url = 'https://api.cloudflare.com/client/v4/';

    public function methodCredentials()
    {
        /* $response = Http::withOptions([
            'verify' => false,
        ])->post($this->url . '/api/auth/login', [
            'email' => $objSetting->email,
            'password' => $objSetting->password,
        ]);

        return json_decode((string) $response->body(), true)['access_token'];*/
    }
}
