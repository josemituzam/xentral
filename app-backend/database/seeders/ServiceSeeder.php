<?php

namespace Database\Seeders;

use App\Models\Landlord\Service\Service;
use App\Models\Landlord\Service\ServiceDetail;
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

        $objServicePlanISP = [
            [
                "min_contracts" => '1',
                "max_contracts" => '50',
                "price_monthly" => '150'
            ],
            [
                "min_contracts" => '51',
                "max_contracts" => '100',
                "price_monthly" => '200'
            ],
            [
                "min_contracts" => '101',
                "max_contracts" => '150',
                "price_monthly" => '300'
            ],
        ];

        $objServicePlanOLT = [
            [
                "min_contracts" => '1',
                "max_contracts" => '50',
                "price_monthly" => '150'
            ],
            [
                "min_contracts" => '51',
                "max_contracts" => '100',
                "price_monthly" => '200'
            ],
            [
                "min_contracts" => '101',
                "max_contracts" => '150',
                "price_monthly" => '300'
            ],
        ];

        $objServicePlanCON = [
            [
                "min_contracts" => '1',
                "max_contracts" => '50',
                "price_monthly" => '150'
            ],
            [
                "min_contracts" => '51',
                "max_contracts" => '100',
                "price_monthly" => '200'
            ],
            [
                "min_contracts" => '101',
                "max_contracts" => '150',
                "price_monthly" => '300'
            ],
        ];

        foreach ($obj as $value) {
            $objService =  Service::create([
                'name' => $value["name"],
                'description' => $value["description"],
                "short_code" => $value["short_code"],
                "order" => $value["order"],
            ]);

            if ($objService->short_code == 'PL1') {
                foreach ($objServicePlanISP as $value) {
                    ServiceDetail::create([
                        "service_id" =>  $objService->id,
                        "min_contracts" => $value["min_contracts"],
                        "max_contracts" => $value["max_contracts"],
                        "price_monthly" => $value["price_monthly"],
                    ]);
                }
            }

            if ($objService->short_code == 'PL2') {
                foreach ($objServicePlanOLT as $value) {
                    ServiceDetail::create([
                        "service_id" =>  $objService->id,
                        "min_contracts" => $value["min_contracts"],
                        "max_contracts" => $value["max_contracts"],
                        "price_monthly" => $value["price_monthly"],
                    ]);
                }
            }



            if ($objService->short_code == 'PL3') {
                foreach ($objServicePlanCON as $value) {
                    ServiceDetail::create([
                        "service_id" =>  $objService->id,
                        "min_contracts" => $value["min_contracts"],
                        "max_contracts" => $value["max_contracts"],
                        "price_monthly" => $value["price_monthly"],
                    ]);
                }
            }
        }
    }
}
