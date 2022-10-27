<?php

namespace Database\Seeders\Tenant;

use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Database\Seeders\Tenant\UserSeeder;
use Database\Seeders\Tenant\PermissionRoleSeeder;

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
        $this->enableForeignKeys();
        Model::reguard();
    }
}
