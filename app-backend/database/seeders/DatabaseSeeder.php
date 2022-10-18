<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Eloquent\Model;
use Database\Seeders\Traits\TruncateTable;
use Database\Seeders\PermissionRoleSeeder;
use Database\Seeders\Traits\DisableForeignKeys;

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
