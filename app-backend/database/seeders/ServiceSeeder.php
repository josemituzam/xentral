<?php

namespace Database\Seeders;

use App\Models\Landlord\Service\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
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
                "name" => 'ISP',
                "short_code" => 'PL1',
                "description" => 'Plan ISP',
                "order" => '1'
            ],
            [
                "name" => 'OLT',
                "short_code" => 'PL2',
                "description" => 'Plan OLT',
                "order" => '2'
            ],
            [
                "name" => 'Contable',
                "short_code" => 'PL3',
                "description" => 'Plan Contable',
                "order" => '3'
            ],
        ];
        foreach ($obj as $value) {
            Service::create([
                'name' => $value["name"],
                'description' => $value["description"],
                "short_code" => $value["short_code"],
                "order" => $value["order"],
            ]);
        }
    }
}
