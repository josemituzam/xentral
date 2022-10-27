<?php

namespace Database\Seeders;

use App\Models\Core\Api\ApiCloudfare;
use Illuminate\Database\Seeder;

class ApiCloudfareSeeder extends Seeder
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
                "token" => '4QNyrjRGHLdWJXzIntcyLYM2KIqQ2QeFQL25tWMU',
                "type" => 'Zone',
                "type_id" => '38f59adc63a503b831a52b959002ee14',
                "ip" => '146.190.72.250',
                "domain" => '.ispxentral.app',
                "long_code" => 'ROOT'
            ],
        ];
        foreach ($obj as $value) {
            ApiCloudfare::create([
                'token' => $value["token"],
                'type' => $value["type"],
                'type_id' => $value["type_id"],
                'ip' => $value["ip"],
                'domain' => $value["domain"],
                'long_code' => $value["long_code"],
            ]);
        }
    }
}
