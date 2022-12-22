<?php

namespace Database\Seeders\tenant;

use App\Models\Tenant\Traits\Sequential\Sequential;
use Illuminate\Database\Seeder;

class SequentialSeeder extends Seeder
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
                'contracts' => 0,
                'tickets' => 0,
                'accounts_receivable' => 0,
                'advances' => 0,
                'returns' => 0,
                'sales_notes' => 0,
                'proformas' => 0,
                'bills' => 0
            ],
        ];

        foreach ($obj as $value) {
            Sequential::create([
                'contracts' => $value["contracts"],
                'tickets' => $value["accounts_receivable"],
                'advances' => $value["advances"],
                'returns' => $value["returns"],
                'sales_notes' => $value["sales_notes"],
                'proformas' => $value["proformas"],
                'bills' => $value["bills"]
            ]);
        }
    }
}
