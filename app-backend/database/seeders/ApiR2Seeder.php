<?php

namespace Database\Seeders;

use App\Models\Core\Api\ApiR2;
use Illuminate\Database\Seeder;

class ApiR2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $obj = [
            [
                "account_id" => '28839a0e9d496f985c2b361662fcdba5',
                "access_key_id" => '115a4f32d3fe156ddc0e0f2ce207e9e5',
                "access_key_secret" => 'ba06d0c655dfc110570152ea2d6b97bbde20e30bc50b0283a529963290d41984',
                "key_image_name" => 'images/',
                "key_file_name" => 'files/',
                "long_code" => 'R2',
                "short_code" => 'PRO'
            ],
        ];
        foreach ($obj as $value) {
            ApiR2::create([
                'account_id' => $value["account_id"],
                'access_key_id' => $value["access_key_id"],
                'access_key_secret' => $value["access_key_secret"],
                'key_image_name' => $value["key_image_name"],
                'key_file_name' => $value["key_file_name"],
                'short_code' =>  $value["short_code"],
                'long_code' => $value["long_code"],
            ]);
        }
    }
}
