<?php

namespace Database\Seeders\tenant;

use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Database\Seeders\tenant\UserSeeder;
use Database\Seeders\tenant\PermissionRoleSeeder;
use Database\Seeders\tenant\IspLastMilesSeeder;
use Database\Seeders\tenant\IspMinimunPermanenceSeeder;
use Database\Seeders\tenant\StatusSeeder;
use Database\Seeders\tenant\PaymentSeeder;
use Database\Seeders\tenant\TemplateContractSeeder;
use Database\Seeders\tenant\IspAnotherProviderSeeder;
use Database\Seeders\tenant\SequentialSeeder;

class DatabaseSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Seeders
        */
        Model::unguard();
        $this->disableForeignKeys();
        $this->call(PermissionRoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(IspLastMilesSeeder::class);
        $this->call(IspMinimunPermanenceSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(TemplateContractSeeder::class);
        $this->call(IspAnotherProviderSeeder::class);
        $this->call(SequentialSeeder::class);
        $this->enableForeignKeys();
        Model::reguard();
    }
}
