<?php

namespace Database\Seeders\tenant;

use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Database\Seeders\tenant\UserSeeder;
use Database\Seeders\tenant\PermissionRoleSeeder;

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
