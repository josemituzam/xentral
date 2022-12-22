<?php

namespace App\Http\Controllers;

use App\Models\Tenant\Traits\Status\Status;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Tenant\Api\ApiR2;
use Aws\Credentials\Credentials;
use Aws\S3\S3Client;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    static function getStatus($type, $service, $shortCode)
    {
        return  Status::where('type', $type)->where('service', $service)->where('short_code', $shortCode)->first()->id;
    }

    static function createFolder($contextableType, $contextableId)
    {
        $objR2 = ApiR2::where('short_code', '=', 'PRO')->first();
        $bucket_name = $objR2->bucket_name;
        $account_id         = $objR2->account_id;
        $access_key_id      = $objR2->access_key_id;
        $access_key_secret  = $objR2->access_key_secret;
        $credentials = new Credentials($access_key_id, $access_key_secret);

        $options = [
            'region' => 'auto',
            'endpoint' => "https://$account_id.r2.cloudflarestorage.com",
            'version' => 'latest',
            'credentials' => $credentials
        ];
        $s3_client = new S3Client($options);

        $s3_client->putObject(array(
            'Bucket' => $bucket_name,
            'Key'    => $contextableType . '/',
        ));

        $s3_client->putObject(array(
            'Bucket' => $bucket_name,
            'Key'    => $contextableType . '/' .  $contextableId . '/' . 'files/',
        ));

        $s3_client->putObject(array(
            'Bucket' => $bucket_name,
            'Key'    => $contextableType . '/' .  $contextableId . '/' . 'images/',
        ));
    }
    
    static function getFolder($contextableType, $contextableId)
    {
        return [
            'folderImage' => $contextableType . '/' .  $contextableId . '/' . 'images/',
            'folderFile' => $contextableType . '/' .  $contextableId . '/' . 'files/'
        ];
    }
}
