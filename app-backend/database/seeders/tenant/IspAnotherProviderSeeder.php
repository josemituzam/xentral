<?php

namespace Database\Seeders\tenant;

use App\Models\Tenant\Isp\Commercial\Contract\IspAnotherProvider;
use Illuminate\Database\Seeder;

class IspAnotherProviderSeeder extends Seeder
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
                'name' => 'Netlife',
                'short_code' => 'AP-01'
            ],
            [
                'name' => 'Movistar',
                'short_code' => 'AP-02'
            ],
            [
                'name' => 'Claro',
                'short_code' => 'AP-03'
            ]
        ];

        foreach ($obj as $value) {
            IspAnotherProvider::create([
                'name' => $value["name"],
                'short_code' => $value["short_code"]
            ]);
        }
    }
}
