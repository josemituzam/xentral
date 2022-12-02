<?php

namespace Database\Seeders\tenant;

use App\Models\Tenant\Isp\Commercial\Plan\IspLastMiles;
use Illuminate\Database\Seeder;

class IspLastMilesSeeder extends Seeder
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
                'name' => 'FIBRA',
                'description' => 'Fibra',
                'short_code' => 'UM-01'
            ],
            [
                'name' => 'INALÁMBRICA',
                'description' => 'Inalámbrica',
                'short_code' => 'UM-02'
            ]
        ];

        foreach ($obj as $value) {
            IspLastMiles::create([
                'name' => $value["name"],
                'description' => $value["description"],
                'short_code' => $value["short_code"]
            ]);
        }
    }
}
