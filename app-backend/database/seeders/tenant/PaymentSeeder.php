<?php

namespace Database\Seeders\tenant;

use App\Models\Tenant\Traits\Payment\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
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
                'name' => 'Crédito con factura',
                'type' => 'contract',
                'class' => 'warning',
                'service' => 'isp'
            ],
            [
                'name' => 'Crédito sin factura',
                'type' => 'contract',
                'class' => 'success',
                'service' => 'isp'
            ],
        ];

        foreach ($obj as $value) {
            Payment::create([
                'name' => $value["name"],
                'type' => $value["type"],
                'class' => $value["class"],
                'service' => $value["service"]
            ]);
        }
    }
}
