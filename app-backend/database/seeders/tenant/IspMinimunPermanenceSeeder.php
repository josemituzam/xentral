<?php

namespace Database\Seeders\tenant;

use App\Models\Tenant\Isp\Commercial\Plan\IspMinimunPermanence;
use Illuminate\Database\Seeder;

class IspMinimunPermanenceSeeder extends Seeder
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
                'name' => 'Tiempo indefinido',
                'description' => 'Tiempo indefinido',
                'short_code' => 'IDF',
                'orderBy' => 1,
            ],
            [
                'name' => '3 meses',
                'description' => '3 meses',
                'short_code' => 'TRE',
                'orderBy' => 2,
            ],
            [
                'name' => '6 meses',
                'description' => '6 meses',
                'short_code' => 'SEI',
                'orderBy' => 3,
            ],
            [
                'name' => '12 meses',
                'description' => '12 meses',
                'short_code' => 'DOC',
                'orderBy' => 4,
            ],
            [
                'name' => '24 meses',
                'description' => '24 meses',
                'short_code' => 'VEI',
                'orderBy' => 5,
            ],
            [
                'name' => '30 meses',
                'description' => '30 meses',
                'short_code' => 'TRT',
                'orderBy' => 6,
            ],
            [
                'name' => '36 meses',
                'description' => '36 meses',
                'short_code' => 'TRS',
                'orderBy' => 7,
            ],
            [
                'name' => '48 meses',
                'description' => '48 meses',
                'short_code' => 'CUA',
                'orderBy' => 8,
            ],
        ];

        foreach ($obj as $value) {
            IspMinimunPermanence::create([
                'name' => $value["name"],
                'description' => $value["description"],
                'short_code' => $value["short_code"],
                'orderBy' => $value["orderBy"],
            ]);
        }
    }
}
