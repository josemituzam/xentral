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
                'name' => 'PRE-ALTA',
                'type' => 'contract',
                'class' => 'warning',
                'service' => 'isp'
            ],
            [
                'name' => 'ACTIVADO',
                'type' => 'contract',
                'class' => 'success',
                'service' => 'isp'
            ],
            [
                'name' => 'CORTADO',
                'type' => 'contract',
                'class' => 'danger',
                'service' => 'isp'
            ],
        ];

        foreach ($obj as $value) {
            Status::create([
                'name' => $value["name"],
                'type' => $value["type"],
                'class' => $value["class"],
                'service' => $value["service"]
            ]);
        }
    }
}
