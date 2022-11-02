<?php

namespace Database\Seeders\tenant;

use App\Models\Core\Auth\Tenant\User;
use App\Models\Core\Auth\Role;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $objUserLandlord = [
            [
                'email' => 'tenant@admin.com',
                'password' => bcrypt('admin'),
            ],
        ];

        foreach ($objUserLandlord as $value) {
            $objUser = User::create([
                'email' => $value["email"],
                'password' =>  $value["password"],
                'email_verified_at' => now(),
            ]);
            $objRoleAdmin = Role::findByName('Root', 'apiTenant');
            $objUser->assignRole($objRoleAdmin);
        }
    }
}
