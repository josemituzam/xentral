<?php

namespace Database\Seeders\tenant;

use App\Models\Tenant\Traits\Template\TemplateContract;
use Illuminate\Database\Seeder;

class TemplateContractSeeder extends Seeder
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
                'name' => 'Contrato AzziNet Cia.Ltda.',
                'template_code' => 'TTC1',
                'orientation' => 'portrait',
                'html' => null,

                'margin_bottom' => '10',
                'margin_left' => '5',
                'margin_top' => '5',
                'margin_right' => '5',

                'size' => 'A4',
                'orderBy' => 1
            ],
            [
                'name' => 'Contrato V.1',
                'template_code' => 'TTC2',
                'orientation' => 'portrait',
                'html' => null,

                'margin_bottom' => '10',
                'margin_left' => '5',
                'margin_top' => '5',
                'margin_right' => '5',

                'size' => 'A4',
                'orderBy' => 2
            ],
            [
                'name' => 'Contrato V.0',
                'template_code' => 'TTC3',
                'orientation' => 'portrait',
                'html' => null,

                'margin_bottom' => '10',
                'margin_left' => '5',
                'margin_top' => '5',
                'margin_right' => '5',

                'size' => 'A4',
                'orderBy' => 3
            ],
        ];

        foreach ($obj as $value) {
            TemplateContract::create([
                'name' => $value["name"],
                'template_code' => $value["template_code"],
                'orientation' => $value["orientation"],
                'html' => $value["html"],
                'margin_bottom' => $value["margin_bottom"],
                'margin_left' => $value["margin_left"],
                'margin_top' => $value["margin_top"],
                'margin_right' => $value["margin_right"],
                'size' => $value["size"],
                'orderBy' => $value["orderBy"]
            ]);
        }
    }
}
