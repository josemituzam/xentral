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
                "type_constrain" => 'A',
                "type_id" => '38f59adc63a503b831a52b959002ee14',
                "ip" => '146.190.72.250',
                "domain" => '.ispxentral.app',
                "long_code" => 'IPV6',
                "short_code" => 'PRO'
            ],
            [
                "token" => '4QNyrjRGHLdWJXzIntcyLYM2KIqQ2QeFQL25tWMU',
                "type" => 'Zone',
                "type_constrain" => 'AAAA',
                "type_id" => '38f59adc63a503b831a52b959002ee14',
                "ip" => '2604:a880:400:d0::1a64:3001',
                "domain" => '.ispxentral.app',
                "long_code" => 'IPV4',
                "short_code" => 'PRO'
            ],
            [
                "token" => '4QNyrjRGHLdWJXzIntcyLYM2KIqQ2QeFQL25tWMU',
                "type" => 'Zone',
                "type_constrain" => 'A',
                "type_id" => '1370560e09cfd9edd12b1d158821ec96',
                "ip" => '146.190.72.250',
                "domain" => '.ispxentral.com',
                "long_code" => 'IPV6',
                "short_code" => 'DEV'
            ],
            [
                "token" => '4QNyrjRGHLdWJXzIntcyLYM2KIqQ2QeFQL25tWMU',
                "type" => 'Zone',
                "type_constrain" => 'AAAA',
                "type_id" => '1370560e09cfd9edd12b1d158821ec96',
                "ip" => '2604:a880:400:d0::199d:f001',
                "domain" => '.ispxentral.com',
                "long_code" => 'IPV4',
                "short_code" => 'DEV'
            ]
        ];
        foreach ($obj as $value) {
            ApiCloudfare::create([
                'token' => $value["token"],
                'type' => $value["type"],
                'type_id' => $value["type_id"],
                'type_constrain' => $value["type_constrain"],
                'ip' => $value["ip"],
                'domain' => $value["domain"],
                'short_code' =>  $value["short_code"],
                'long_code' => $value["long_code"],
            ]);
        }
    }
}
