<?php

namespace Database\Seeders\tenant;

use App\Models\Tenant\Traits\Status\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
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
                'name' => 'EN PROCESO',
                'short_code' => 'EPO',
                'type' => 'contract',
                'class' => 'info',
                'service' => 'isp'
            ],
            [
                'name' => 'FIRMADO',
                'short_code' => 'FDO',
                'type' => 'contract',
                'class' => 'warning',
                'service' => 'isp'
            ],
            [
                'name' => 'SIN FIRMAR',
                'short_code' => 'SFR',
                'type' => 'contract',
                'class' => 'warning',
                'service' => 'isp'
            ],
            [
                'name' => 'PRE-ALTA',
                'short_code' => 'PTA',
                'type' => 'contract',
                'class' => 'info',
                'service' => 'isp'
            ],
            [
                'name' => 'ACTIVADO',
                'type' => 'contract',
                'short_code' => 'ATO',
                'class' => 'success',
                'service' => 'isp'
            ],
            [
                'name' => 'CORTADO',
                'type' => 'contract',
                'short_code' => 'CTO',
                'class' => 'danger',
                'service' => 'isp'
            ],
            [
                'name' => 'PENDIENTE',
                'type' => 'file',
                'short_code' => 'PTE',
                'class' => 'danger',
                'service' => 'isp'
            ],

            [
                'name' => 'CARGADO',
                'type' => 'file',
                'short_code' => 'CGO',
                'class' => 'success',
                'service' => 'isp'
            ],
        ];

        foreach ($obj as $value) {
            Status::create([
                'name' => $value["name"],
                'type' => $value["type"],
                'short_code' => $value["short_code"],
                'class' => $value["class"],
                'service' => $value["service"]
            ]);
        }
    }
}
