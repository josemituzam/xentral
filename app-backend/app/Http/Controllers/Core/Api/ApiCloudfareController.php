<?php

namespace App\Http\Controllers\Core\Api;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class ApiCloudfareController extends Controller
{
    protected $url = 'https://api.cloudflare.com/client/v4/';

    public function createSubDomain($subdomain, $obj)
    {
        return Http::withOptions([
            'verify' => true,
        ])->withHeaders([
            'Authorization' => 'Bearer ' . $obj->token,
        ])->post($this->url . 'zones/' . $obj->type_id . '/dns_records', [
            'type' => 'A',
            'name' => $subdomain .  $obj->domain,
            'content' =>  $obj->ip,
            'ttl' => 1,
            'proxied' => true
        ]);
    }
}
