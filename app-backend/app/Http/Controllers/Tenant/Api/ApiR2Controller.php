<?php

namespace App\Http\Controllers\Tenant\Api;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Api\ApiR2;
use Illuminate\Support\Facades\Storage;
use Aws\Credentials\Credentials;
use Aws\S3\S3Client;

class ApiR2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveFile()
    {
        $objR2 = ApiR2::where('short_code', '=', 'PRO')->first();
        $bucket_name = $objR2->bucket_name;
        $account_id         = $objR2->account_id;
        $access_key_id      = $objR2->access_key_id;
        $access_key_secret  = $objR2->access_key_secret;

        config([
            'filesystems.disks.s3.key' => $access_key_id,
            'filesystems.disks.s3.secret' => $access_key_secret,
            'filesystems.disks.s3.region' => 'auto',
            'filesystems.disks.s3.bucket' =>  $bucket_name,
            'filesystems.disks.s3.endpoint' => "https://$account_id.r2.cloudflarestorage.com",
        ]);

        return $objR2;
    }

    public function getFile()
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
        $plain_url = $s3_client->getObjectUrl('my-bucket-name', 'hello.txt');
      //  $client = Storage::disk('s3')->getAdapter();
        return $objR2;
    }
}